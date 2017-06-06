<?php
namespace soss_socy_fashion\V1\Rest\Theme;

use Zend\Db\Sql\Select;

class ThemeSelect extends \Zend\Db\Sql\Select
{
    public static $tableName = 'themes';
    
    public function __construct()
    {
       parent::__construct(self::$tableName);
    }
  
    
    public function extra()
    {
      $this->group(self::$tableName.'.theme_id');
      return $this->joined();
    }
  
    
    public function joined()
    {
       $this->join('encounters', 'encounters.theme_id = themes.theme_id', 
                   array('count_encounters' => new \Zend\Db\Sql\Expression("IFNULL(COUNT(encounters.encounter_id),0)")),
                   self::JOIN_LEFT)
            ->join('images', 'images.encounter_id = encounters.encounter_id', array('count_approved_images' => new \Zend\Db\Sql\Expression("IFNULL(SUM(images.approved),0)")),
                 self::JOIN_LEFT);
                   
       return $this;
    }
  
  
  
}