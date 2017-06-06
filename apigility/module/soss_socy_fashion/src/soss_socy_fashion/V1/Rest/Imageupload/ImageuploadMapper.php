<?php
namespace soss_socy_fashion\V1\Rest\Imageupload;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use ZF\ApiProblem\ApiProblem;

use soss_socy_fashion\lib;

class ImageuploadMapper extends \soss_socy_fashion\lib\MapperBase
{
    protected static $_tableName = 'images';
    protected static $_pk = 'image_id';
    protected $select;
    
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
        
    }
    
    
    public function create($data)
    {
        $insert = array('image_filename' => $data['savedAs'],
                  'encounter_id' => $data['encounter_id'],
                  'image_owner_id' => $_SESSION['SFI_USER']['UID']
                 );
        
        $this->_tableGateway->insert($insert);
        
        return $insert;
    }
    
    
}