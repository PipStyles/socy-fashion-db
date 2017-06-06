<?php

namespace soss_socy_fashion\lib;



class EntityBase {
  
  
  public function __construct($data = null)
  {
      if($data !== null && is_array($data))
      {
        $this->exchangeArray($data);     
      }
      elseif (is_object($data))
      {
          $this->exchangeObject($data);
      }
  }
  
    
    
    
  public function getArrayCopy()
  {
    $out = [];
    
    foreach(get_object_vars($this) as $k => $v)
    {
       $out[$k] = $v;
    }
    
    return $out;
  }
  
  public function exchangeObject($obj)
  {
      foreach(get_object_vars($data) as $k => $v) 
      {
         $this->$k = $v;
      }
  }
        
  public function exchangeArray(array $a)
  {
    foreach($a as $k => $v)
    {
      $this->$k = $v;
     
    }
  }
  
}