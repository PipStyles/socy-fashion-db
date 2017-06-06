<?php
namespace soss_socy_fashion\V1\Rest\Imageupload;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use \Zend\Db\TableGateway\TableGateway;

class ImageuploadResource extends AbstractResourceListener
{
   
    protected $mapper;
    public function __construct($mapper)
    {
        $this->mapper = $mapper;
    }
    
    
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $inputFilter = $this->getInputFilter();
        $data = $inputFilter->getValues();
        $image = $inputFilter->getValue('file');
        
        $destFolder =  '../i/'.$data['encounter_id'];
        if(!is_dir('../i'))
        {
            mkdir('../i');
        }
        
        if(!is_dir($destFolder))
        {
           mkdir($destFolder);
        }
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        
        $filename = basename($image['name'],'.'.$ext).'_'.$_SESSION['SFI_USER']['UID'].'_'.date('Y-m-d-H-i-s').'.'.$ext;
        
        move_uploaded_file($image['tmp_name'], $destFolder.'/'.$filename);
        
        $data['savedAs'] = $filename;
        
        return $this->mapper->create($data);
    }

    
    
    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        
        //id string is folder/filename
        
        
        
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
