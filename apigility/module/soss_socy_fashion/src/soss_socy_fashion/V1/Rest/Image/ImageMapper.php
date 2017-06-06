<?php
namespace soss_socy_fashion\V1\Rest\Image;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use ZF\ApiProblem\ApiProblem;

use soss_socy_fashion\lib;


class ImageMapper extends \soss_socy_fashion\lib\MapperBase
{
    protected static $_tableName = 'images';
    protected static $_pk = 'image_id';
    protected $select;
    protected $_ownColumns;
  
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
        $this->_ownColumns = $this->_columnNameArray(self::$_tableName);
    }
    
    public function update($id, $data)
    {
        $table = new \Zend\Db\TableGateway\TableGateway(self::$_tableName, $this->adapter);
        
        $existing = $table->select(array(self::$_pk => $id));
        
        if($existing->current())
        {
            //check ownership...
            $row = $existing->current();
            $data = $this->_getOwnData($data);
            
            if(count($data) && 
                ($row->image_owner_id == $_SESSION['SFI_USER']['UID'] || $_SESSION['SFI_USER']['IS_ADMIN']))
            {
                //is owner or admin, update
                $table->update($data, array(self::$_pk => $id));
            }
            else
            {
               return new ApiProblem(401, "You are not the owner of image $id, or you are not admin"); 
            }
            
        }
        
        return $this->fetch($id);
    }
    
    public function fetch($id)
    {
        
        $select = new \Zend\Db\Sql\Select(self::$_tableName);
        $select->where(array(self::$_pk => $id));
        $statement = $this->adapter->query($select->getSqlString($this->adapter->getPlatform())); 
        $res = $statement->execute();
        
        return new ImageEntity($res->current());
    }
    
    
    public function fetchAll($params)
    {
        $select = new \Zend\Db\Sql\Select(self::$_tableName);
        $select->where((array) $params)
               ->where(array('_deleted' => 0));
        
        return new ImageCollection(new DbSelect($select, $this->adapter));
    }
    
    
    
    
    
}