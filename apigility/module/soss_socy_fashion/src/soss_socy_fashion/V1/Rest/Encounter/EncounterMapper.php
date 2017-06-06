<?php
namespace soss_socy_fashion\V1\Rest\Encounter;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use ZF\ApiProblem\ApiProblem;

use soss_socy_fashion\lib;
use soss_socy_fashion\V1\Rest\Encounter\EncounterSelect;

class EncounterMapper extends \soss_socy_fashion\lib\MapperBase
{
    protected static $_tableName = 'encounters';
    protected static $_pk = 'encounter_id';
    protected $select;
    protected $_ownColumns = array();

    protected static $_calculatedColumns = array('count_images', 'approved_images', 'unapproved_images');


    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
        $this->select = new EncounterSelect();
        $this->_ownColumns = $this->_columnNameArray(self::$_tableName);
    }

    public function fetchAll($params = null)
    {
      $select = $this->select->all($params);
      //seriously? there must be a better way...

      if($params)
      {
        foreach($params->toArray() as $k => $v)
         {
            if(array_key_exists($k, $this->_ownColumns))
            {
              $select->where(array(self::$_tableName.'.'.$k => $v));
            }
            elseif(in_array($k, self::$_calculatedColumns))
            {
                //$select->having(array($k => $v));
            }
         }


        if(isset($params->tag_ids))
        {
           $select->filterTags($params->tag_ids);
        }

        //echo $select->getSqlString();

      }

      return new EncounterCollection(new DbSelect($select, $this->adapter));
    }


    public function fetch($id)
    {
        $sql = new Sql($this->adapter);
        $select = $this->select->one($id);

        $statement = $this->adapter->query($select->getSqlString($this->adapter->getPlatform()));

        //echo $select->getSqlString($this->adapter->getPlatform())."\n\r";

        $res = $statement->execute();

        $resultSet = new ResultSet;
        $resultSet->initialize($res);

        $resArray = $resultSet->toArray();
        if(!count($resArray))
        {
           return new ApiProblem(404, "Encounter with id of $id not found");
        }


        $main = $resArray[0];

        $out = array_intersect_key($main, array_merge($this->_columnNameArray(self::$_tableName), array_flip(array('theme_name', 'owner_name'))));


        if(isset($main['subject_id']) && isset($main['subject_email']))
        {
          $out['subject'] = array_intersect_key($main, array_flip(array('subject_id', 'subject_email','subject_consent', 'subject_firstname','subject_lastname', 'subject_tel')));
        }

        //$out['images'] = array();
        $imagesFields = $this->_columnNameArray('images');
        //$out['tags'] = array();
        $tagsFields = $this->_columnNameArray('tags');
        //$out['clothing'] = array();
        $clothingFields = $this->_columnNameArray('clothing');


        //map through tags, clothings.
        //IMPROVE: this should be done in a more "apigility" way using zf-hal objects
        foreach($resArray as $i => $row)
        {
            if(isset($row['image_id']) && !isset($out['images'][$row['image_id']]))
            {
                if(!is_array($out['images']))
                {
                  $out['images'] = array();
                }
                $out['images'][$row['image_id']] = array_intersect_key((array) $row, $imagesFields);
            }

            if(isset($row['tag_id']) && !isset($out['tags'][$row['tag_id']]))
            {
              if(!is_array($out['tags']))
                {
                  $out['tags'] = array();
                }

              $out['tags'][$row['tag_id']] = array_intersect_key((array) $row, $tagsFields);
            }

            if(isset($row['clothing_id']) && !isset($out['clothing'][$row['clothing_id']]))
            {
               if(!is_array($out['clothing']))
                {
                  $out['clothing'] = array();
                }

              $out['clothing'][$row['clothing_id']] = array_intersect_key((array) $row, $clothingFields);
            }
        }

        return new EncounterEntity($out);
    }



    public function create($data)
    {
      $own_data = $this->_getOwnData($data);
      $own_data['owner_id'] = $_SESSION['SFI_USER']['UID'];
      $insert = $this->_tableGateway->insert($own_data);
      $id = $this->_tableGateway->lastInsertValue;
      $this->_setRelated($id, (array) $data);
      $this->log($_SESSION['SFI_USER']['UID'], __FUNCTION__, serialize($data));
      return $this->fetch($id);
    }



    public function update($id, $data)
    {
       $row = $this->_tableGateway->select(array(self::$_pk => $id))->current();

       if(!$_SESSION['SFI_USER']['IS_ADMIN'] && $row->owner_id  !== $_SESSION['SFI_USER']['UID'])
       {
          return new ApiProblem(403, 'User is not the owner or admin');
       }

        $own_data = $this->_getOwnData($data);
        //print_r($own_data);


        $own_data['last_edited_by'] = $_SESSION['UOM_CAS_USER_ATTRIBUTES']['attribute']['umanPersonID'];
        $own_data['edited_timestamp'] = date('Y-m-d H:i:s');

        $this->_tableGateway->update($own_data, array(self::$_pk => $id));

        //process images, tags, clothing...
        $this->_setRelated($id, (array) $data);
        $this->log($_SESSION['SFI_USER']['UID'], __FUNCTION__, serialize($data));

        return $this->fetch($id);
    }



    private function _setRelated($id,  $data)
    {
        $data = (array) $data;

        //create or update images, tags, clothing...

        if(isset($data['images']))
        {
           $this->_setImages($id, (array) $data['images']);
        }

        if(isset($data['tags']))
        {
           $this->_setTags($id, (array) $data['tags']);
        }

        if(isset($data['clothing']))
        {
           $this->_setClothing($id, (array) $data['clothing']);
        }

        if(isset($data['subject']))
        {
            //create/update subject
            $subject_id = $this->_addSubject($data['subject']);
            //set the encounter to have correct subject id...
            $this->_tableGateway->update(array('subject_id' => $subject_id),
                                         array('encounter_id' => $id));

        }

    }

    protected function _addSubject($data)
    {
        $data['subject_email'] = strtolower($data['subject_email']);
        $table = new \Zend\Db\TableGateWay\TableGateway('subjects', $this->adapter);

        $existing = $table->select(array('subject_email' => $data['subject_email']));

        $saveData = $this->_getOwnData($data, 'subjects');

       if($existing->count())
       {
          //update...
          $table->update($saveData, array('subject_email' => $data['subject_email']));
          $ret = $existing->current()->subject_id;
       }
        else
        {
          //add...
          $table->insert((array) $saveData);
          $ret = $table->lastInsertValue;
        }

      return $ret;
    }





    protected function _setImages($encounter_id, $images)
    {
       $table = new \Zend\Db\TableGateWay\TableGateway('images', $this->adapter);

        //set all as "deleted"...
        $table->update(array('_deleted' => 1),
                      array('encounter_id' => $encounter_id));

        //then undelete each if found from the resent data...

       $fields = $this->_columnNameArray('images');

       foreach($images as $image)
       {
         $image['_deleted'] = 0;
         $table->update(array_intersect_key($image, $fields),
                         array('image_id' => $image['image_id']));
       }

       //now move any remaining _deleted to del_images...
       $this->_deleteEncounterImages();
    }


    protected function _addImage($encounter_id, $image)
    {



    }



    protected function _setTags($encounter_id, $tags)
    {
       $table = new \Zend\Db\TableGateWay\TableGateway('tags', $this->adapter);

        $joinTable = new \Zend\Db\TableGateWay\TableGateway('encounters_tags', $this->adapter);

        //clear existing...
        $joinTable->delete(array('encounter_id' => $encounter_id));

        $this->log($_SESSION['SFI_USER']['UID'], 'update', serialize($tags));


        foreach((array) $tags as $tag)
        {
            $existing = $table->select(array('tag_name' => $tag['tag_name']));

            if(count($existing))
            {
                //existing tag - just add to joining table
                $this->_addTag($encounter_id, $existing->current()->tag_id);
            }
            else
            {
                $table->insert(array('tag_name' => $tag['tag_name']));
               $this->_addTag($encounter_id, $table->lastInsertValue);
            }
        }

    }


    protected function _addTag($encounter_id, $tag_id)
    {
       $joinTable = new \Zend\Db\TableGateWay\TableGateway('encounters_tags', $this->adapter);
       return $joinTable->insert(array('encounter_id' => $encounter_id, 'tag_id' => $tag_id));
    }



    protected function _setClothing($encounter_id, $clothing)
    {
       $table = new \Zend\Db\TableGateWay\TableGateway('clothing', $this->adapter);

        $table->delete(array('encounter_id' => $encounter_id));

        $fields = $this->_columnNameArray('clothing');

        foreach($clothing as $clo)
        {
            $data = array_intersect_key($clo, $fields);
            $data['encounter_id'] = $encounter_id;
              //insert new clothing...
              $this->log($_SESSION['SFI_USER']['UID'], 'create', serialize($data));
           $table->insert((array) $data);
        }
        return;
    }



    protected function _archiveEncounterImages($encounter_id = null)
    {
        $delImg = new \Zend\Db\TableGateWay\TableGateway('del_images', $this->adapter);
        $imgTable = new \Zend\Db\TableGateWay\TableGateway('images', $this->adapter);

        $images = $encounter_id ? $imgTable->select(array(self::$_pk => $encounter_id))
           : $imgTable->select(array('_deleted' => 1));

        if(count($images))
        {
            foreach($images as $img)
            {
              try {
                  $delImg->insert((array) $img);
              } catch(Exception $e) {
                  //silent fail - attempting to insert already inserted?
              }
            }
        }

        return;
    }


    protected function _deleteEncounterImages($encounter_id = null)
    {
       //move and delete _delete flagged images across, or move/delete those for given encounter id

        $imgTable = new \Zend\Db\TableGateWay\TableGateway('images', $this->adapter);
        $this->_archiveEncounterImages($encounter_id);
        $encounter_id ? $imgTable->delete(array(self::$_pk => $encounter_id))
           : $imgTable->delete(array('_deleted' => 1));

       return;
    }





    public function delete($id)
    {
        $delRow = $this->_tableGateway->select(array(self::$_pk => $id))->current();

        //check ownership or admin...
        if($delRow->owner_id == $_SESSION['SFI_USER']['UID'] || $_SESSION['SFI_USER']['IS_ADMIN'])
        {
            $this->log($_SESSION['SFI_USER']['UID'], 'pseudo-delete', 'encounter '.$id);

            //ok, "delete" it
            $delEnc = new \Zend\Db\TableGateWay\TableGateway('del_encounters', $this->adapter);
            //copy encounter row to del_encounters

            $existing = $delEnc->select(array(self::$_pk => $id));
            if(!$existing)
            {
              $delEnc->insert((array) $row);
            }

            //delete images BEFORE cascade occurs on encounters delete trigger...
            $this->_deleteEncounterImages($id);
            //delete from encounters...
            $this->_tableGateway->delete(array(self::$_pk => $id));

        }

       return true;
    }

    public function trueDelete($id)
    {
      $this->log($_SESSION['SFI_USER']['UID'], 'delete', 'encounter '.$id);
        return $this->_tableGateway->delete(array(self::$_pk => $id));
    }


}
