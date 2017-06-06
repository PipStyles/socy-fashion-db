<?php
namespace soss_socy_fashion\V1\Rest\Theme;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use ZF\ApiProblem\ApiProblem;

use soss_socy_fashion\lib;
use soss_socy_fashion\V1\Rest\Theme\ThemeSelect;

class ThemeMapper extends \soss_socy_fashion\lib\MapperBase
{
    protected static $_tableName = 'themes';
    protected static $_pk = 'theme_id';
    protected $select;
    protected $_ownColumns = array();
    
    protected static $_calculatedColumns = array('count_encounters', 'count_approved_images');
    
  
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
        $this->select = new ThemeSelect();
        $this->_ownColumns = $this->_columnNameArray(self::$_tableName);
    }
    
    public function fetchAll($params = null)
    {
      $select = $this->select->extra();
      //echo $select->getSqlString();
      
      return new ThemeCollection(new DbSelect($this->select, $this->adapter));
    }
  
    public function fetch($id)
    {
      $select = $this->select->where(array(self::$_pk => $id));
      $statement = $this->adapter->query($select->getSqlString($this->adapter->getPlatform())); 
      $res = $statement->execute();
      return new ThemeEntity($res->current());
    }
    
  
    public function create($data)
    {
      
      $insert = $this->_tableGateway->insert((array) $data);
      $id = $this->_tableGateway->lastInsertValue;
      $this->log($_SESSION['SFI_USER']['UID'], __FUNCTION__, serialize($data));
      return $this->fetch($id);
    }
    
  
}