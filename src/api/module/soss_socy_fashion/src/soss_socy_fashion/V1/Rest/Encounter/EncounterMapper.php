<?php
namespace soss_socy_fashion\V1\Rest\Encounter;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

use soss_socy_fashion\lib;
use soss_socy_fashion\V1\Rest\Encounter\EncounterSelect;

class EncounterMapper extends \soss_socy_fashion\lib\MapperBase
{
    protected static $_tableName = 'encounters';
    protected static $_pk = 'encounter_id';
    protected $select;
    protected $_ownColumns = array();
  
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
        $this->select = new EncounterSelect();
        $this->_ownColumns = $this->_columnNameArray(self::$_tableName);
    }
    
    public function fetchAll($params = null)
    { 
      $select = $this->select->all();
      //seriously? there must be a better way...
      if($params)
      {
        foreach($params->toArray() as $k => $v)
         {
            $select->where(array((array_key_exists($k, $this->_ownColumns) ? self::$_tableName.'.' : '').$k => $v));
         }
      }
      
      return new EncounterCollection(new DbSelect($select, $this->adapter));
    }
  
    
    public function fetch($id)
    {
        $sql = new Sql($this->adapter);
            
        $statement = $sql->prepareStatementForSqlObject($this->select->one($id));
        $res = $statement->execute();
        
        $out = array_intersect_key($res->current(), array_merge($this->_columnNameArray(self::$_tableName), array('theme_name')));
        
        $out['subject'] = array();
        
        if(isset($res->current()['subject_id']))
        {
          $out['subject'] = array_intersect_key($res->current(), 
                              array_flip(array('subject_id', 'subject_email','subject_consent', 'subject_firstname','subject_lastname')));
        }
        
        $out['images'] = array();  
        $out['tags'] = array();  
        $out['clothing'] = array();  
      
        $resultSet = new ResultSet;
        $resultSet->initialize($res);
        
        //map through tags, clothings.
        //IMPROVE: this should be done in a more "apigility" way using zf-hal objects
        foreach($resultSet as $row)
        {
            if(isset($row->image_id) && !isset($out['images'][$row->image_id]))
            {
                $out['images'][$row->image_id] = array(
                  'image_id' => $row->image_id,
                  'image_detail' => $row->image_detail,
                  'image_filename' => $row->image_filename,
                ); 
            }
            
            if(isset($row->tag_id) && !isset($out['tags'][$row->tag_id]))
            {
                $out['tags'][$row->tag_id] = array(
                  'tag_id' => $row->tag_id,
                  'tag_name' => $row->tag_name 
                  );
            }
            
            if(isset($row->clothing_id) && !isset($out['clothing'][$row->clothing_id]))
            {
                $out['clothing'][$row->clothing_id] = array(
                  'clothing_id' => $row->clothing_id,
                  'clothing_item' => $row->clothing_item  
                  );
            }
        }
        
        return new EncounterEntity($out);
    }
  
    
    public function create($data)
    {
      $insert = $this->_tableGateway->insert($data);
      return $this->fetch($this->_tableGateway->lastInsertValue);
    }
  
    public function update($id, $data)
    {
      $row = $this->_tableGateway->select(array(self::$_pk => $id))->current();
      $row->update($data);
      return $this->fetch($id);
    }
  
    public function delete($id)
    {
       return $this->_tableGateway->delete(array(self::$_pk => (int)$id));
    }
    
  
}