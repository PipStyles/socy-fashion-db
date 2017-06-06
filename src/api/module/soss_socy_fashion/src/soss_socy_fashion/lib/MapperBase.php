<?php
namespace soss_socy_fashion\lib;

use Zend\Db\Sql\Select;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\TableGateway;

abstract class MapperBase
{
  
  protected static $_tableName;
  protected $adapter;
  protected $_tableGateway;
  protected $_dbMeta;
  
  public function __construct(AdapterInterface $adapter)
  {
      $this->adapter = $adapter;
      $this->_tableGateway = new TableGateway(static::$_tableName, $this->adapter);
      $this->_dbMeta = new \Zend\Db\Metadata\Metadata($this->adapter);
  }
  
  protected function _columnNameArray($tableName) {
   
    $table = $this->_dbMeta->getTable($tableName);
    
    $out = array();
    foreach($table->getColumns() as $col)
    {
      $out[$col->getName()] = $col;
    }
    
    return $out;
  }
  
  
  
  protected function applySelectParams($select, $params)
  {
    foreach($params as $k => $p)
    {
      if(property_exists(get_class($this), $k))
      {
        $select->where($k.' = ?', $p);
      }
    } 
  }
  
  protected function log($user, $str)
  {
    $table = new Zend\Db\TableGateway\TableGateway('log');
    return $table->insert(array('user' => $user, 'entry' => $str));
  }
  
  
  
}