<?php 

namespace soss_socy_fashion\lib;
/**
 * Interface for StatusLib mappers
 */

interface MapperInterface
{
    /**
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function create($data);
    /**
     * @param string $id 
     * @return Entity
     */
    public function fetch($id);
    /**
     * @return Collection
     */
    public function fetchAll();
    /**
     * @param string $id 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function update($id, $data);

    /**
     * @param string $list 
     * @param array|\stdClass $list 
     * @return Collection
     */
    public function replaceList($list);

    /**
     * @param string $id 
     * @return bool
     */    
    public function delete($id);
    
    
    
    
}