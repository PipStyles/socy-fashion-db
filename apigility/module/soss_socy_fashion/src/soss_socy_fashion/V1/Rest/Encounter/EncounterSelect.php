<?php
namespace soss_socy_fashion\V1\Rest\Encounter;

use Zend\Db\Sql\Select;


class EncounterSelect extends \Zend\Db\Sql\Select
{
    public static $tableName = 'encounters';


    public function __construct()
    {
       parent::__construct(self::$tableName);

    }

    public function all($params = null)
    {
      $this->joinedCollection($params);

      if(isset($params['cohort']))
      {
        $this->where(array('users.user_cohort' => $params['cohort']));
      }
      //print_r($params);
      return $this;
    }

    public function one($id)
    {
        $select =  $this->joinedOne()->where(array(self::$tableName.'.encounter_id' => $id));
        return $select;
    }

    public function joinedOne()
    {

      //return full joined version, with every row

         $this->join('themes', self::$tableName.'.theme_id = themes.theme_id', array('theme_name'), self::JOIN_LEFT)

             ->join('users', self::$tableName.'.owner_id = users.user_id'
                    , array('owner_name' => new \Zend\Db\Sql\Expression("CONCAT(users.firstname,' ',users.lastname)")), self::JOIN_LEFT)

          //only join SUBJECT for owner and admins... clunky! Consider function
          ->join('subjects',
                 new \Zend\Db\Sql\Expression(self::$tableName.'.subject_id = subjects.subject_id AND ('.self::$tableName.'.owner_id = '.$_SESSION['SFI_USER']['UID'].' OR '.(int) $_SESSION['SFI_USER']['IS_ADMIN'].')'), array('*'), self::JOIN_LEFT)

           ->join(array('last_edited_user_table' => 'users'), self::$tableName.'.last_edited_by = last_edited_user_table.user_id'
                    , array('last_edited_name' => new \Zend\Db\Sql\Expression("CONCAT(last_edited_user_table.firstname,' ',last_edited_user_table.lastname)")), self::JOIN_LEFT)

             //this is derp! Should refactor into image mapper and use that.
              ->join('images',
                     new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = images.encounter_id
                     AND images.image_filename IS NOT NULL
                     AND (images.approved = 1
                          OR images.image_owner_id = '.$_SESSION['SFI_USER']['UID'].'
                          OR '.(int) $_SESSION['SFI_USER']['IS_ADMIN'].')')
                    , array('image_id','image_detail', 'image_owner_id', 'image_filename', 'approved')
                    , self::JOIN_LEFT)

             ->join('clothing',
                    new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = clothing.encounter_id')
                    , array('clothing_id','clothing_item', 'clothing_months_owned', 'clothing_origin', 'clothing_designer')
                    , self::JOIN_LEFT)

             ->join('encounters_tags',
                    new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = encounters_tags.encounter_id')
                    , array()
                    , self::JOIN_LEFT)

             ->join('tags',
                    new \Zend\Db\Sql\Expression('tags.tag_id = encounters_tags.tag_id')
                    , array('*')
                    , self::JOIN_LEFT);

        return $this;
    }


    public function joinedCollection($params = null)
    {
        $this->joined($params);
        $this->group(self::$tableName.'.encounter_id');
        return $this;
    }


    public function joined($params = null)
    {
        $this->join('themes', self::$tableName.'.theme_id = themes.theme_id', array('theme_name'), self::JOIN_LEFT)

             ->join('users', self::$tableName.'.owner_id = users.user_id'
                    , array('owner_name' => new \Zend\Db\Sql\Expression("CONCAT(users.firstname,' ',users.lastname)"),
                    'user_cohort'
                  ), self::JOIN_LEFT)

             ->join(array('last_edited_user_table' => 'users'), self::$tableName.'.last_edited_by = last_edited_user_table.user_id'
                    , array('last_edited_name' => new \Zend\Db\Sql\Expression("CONCAT(last_edited_user_table.firstname,' ',last_edited_user_table.lastname)")), self::JOIN_LEFT)

            ->join('images', new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = images.encounter_id')
                    , array('count_images' => new \Zend\Db\Sql\Expression("COUNT(images.image_id)"),
                            'unapproved_images' => new \Zend\Db\Sql\Expression("IFNULL(SUM(images.approved = 0),0)"),
                            'approved_images' => new \Zend\Db\Sql\Expression("IFNULL(SUM(images.approved),0)")
                           )
                    , self::JOIN_LEFT);



        if(isset($params['unapproved']))
        {
            //return only encounters which have unapproved images attached...
            $having  = 'unapproved_images '. ($params['unapproved']?'>':'=') .' 0';
            $this->having($having);
        }


        return $this;
    }


    public function filterTags($tag_ids)
    {
      $this->_joinTags();
      $this->where->in('tags.tag_id', (array) is_string($tag_ids) ? explode(',', $tag_ids) : $tag_ids);
      return;
    }


    protected function _joinTags()
    {
       $this->join('encounters_tags', 'encounters.encounter_id = encounters_tags.encounter_id', array(), self::JOIN_LEFT)
            ->join('tags', 'encounters_tags.tag_id = tags.tag_id', array(), self::JOIN_LEFT);
       return;
    }


    public function notDeleted($_select = null)
    {
        //return $this->where(array(self::$tableName.'._deleted' => 0));
    }

    public function deleted($_select = null)
    {
        //return $this->where(array(self::$tableName.'._deleted' => 1));
    }





}
