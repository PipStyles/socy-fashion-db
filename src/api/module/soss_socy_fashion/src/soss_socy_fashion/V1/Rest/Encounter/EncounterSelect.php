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
    
    public function one($id)
    {
        return $this->joinedOne()->where(array(self::$tableName.'.encounter_id' => $id));
    }
    
    
    public function joinedOne()
    {
        //return full joined version, with every row
        //$this->joined();
        
         $this->join('themes', self::$tableName.'.theme_id = themes.theme_id', array('theme_name'), self::JOIN_LEFT)
          
             ->join('users', self::$tableName.'.owner_id = users.user_id'
                    , array('owner_name' => new \Zend\Db\Sql\Expression("CONCAT(users.firstname,' ',users.lastname)")), self::JOIN_LEFT)
           
             ->join('subjects', self::$tableName.'.subject_id = subjects.subject_id'
                    , array('*'), self::JOIN_LEFT)
             
             ->join(array('last_edited_user_table' => 'users'), self::$tableName.'.last_edited_by = last_edited_user_table.user_id'
                    , array('last_edited_name' => new \Zend\Db\Sql\Expression("CONCAT(last_edited_user_table.firstname,' ',last_edited_user_table.lastname)")), self::JOIN_LEFT)
             
              ->join('images', new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = images.encounter_id AND images._deleted = 0')
                    , array('image_id','image_detail', 'image_owner_id', 'image_filename')
                    , self::JOIN_LEFT)
             
             ->join('encounters_tags', 
                    new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = encounters_tags.encounter_id')
                    , array()
                    , self::JOIN_LEFT)
             
             ->join('tags', 
                    new \Zend\Db\Sql\Expression('tags.tag_id = encounters_tags.tag_id')
                    , array('*')
                    , self::JOIN_LEFT)
           
             ->join('clothing', 
                    new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = clothing.encounter_id')
                    , array('clothing_id','clothing_item')
                    , self::JOIN_LEFT);
        
        return $this;
    }
    
    
    public function joinedCollection($join_columns = null)
    {
        $this->joined();
        $this->group(self::$tableName.'.encounter_id');
        return $this;
    }
    
    
    public function joined()
    {
        $this->join('themes', self::$tableName.'.theme_id = themes.theme_id', array('theme_name'), self::JOIN_LEFT)
          
             ->join('users', self::$tableName.'.owner_id = users.user_id'
                    , array('owner_name' => new \Zend\Db\Sql\Expression("CONCAT(users.firstname,' ',users.lastname)")), self::JOIN_LEFT)
            
             ->join(array('last_edited_user_table' => 'users'), self::$tableName.'.last_edited_by = last_edited_user_table.user_id'
                    , array('last_edited_name' => new \Zend\Db\Sql\Expression("CONCAT(last_edited_user_table.firstname,' ',last_edited_user_table.lastname)")), self::JOIN_LEFT)
             
             ->join('images', new \Zend\Db\Sql\Expression(self::$tableName.'.encounter_id = images.encounter_id AND images._deleted = 0')
                    , array('count_images' => new \Zend\Db\Sql\Expression("COUNT(images.image_id)"),
                            'unapproved_images' => new \Zend\Db\Sql\Expression("SUM(images.approved = 0)"),
                            'approved_images' => new \Zend\Db\Sql\Expression("SUM(images.approved)")
                           )
                    , self::JOIN_LEFT);
        
        return $this;
    }
    
    
    
    public function all()
    {
      return $this->joinedCollection();
    }
    
    public function notDeleted() 
    {
     return $this->where(array(self::$tableName.'._deleted' => 0)); 
    }
    
    public function deleted($_select = null)
    {
        return $this->where(array(self::$tableName.'._deleted' => 1));
    }
    
    
    
    
    
}