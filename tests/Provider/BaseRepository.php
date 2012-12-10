<?php

namespace Provider;
use Exception;
use Model\Cache\Php;
use Model\Entity\Entity;
use Model\Repository\RepositoryAbstract;

abstract class BaseRepository extends RepositoryAbstract
{
    public $findByIdCallCount = 0;

    private $entities = array();

    protected function findById($id)
    {
        if (isset($this->entities[$id])) {
            $entity = $this->entities[$id];
        } else {
            $entity = false;
        }
        
        ++$this->findByIdCallCount;
        
        return $entity;
    }
    
    protected function remove(Entity $entity)
    {
        unset($this->entities[$entity->id]);
    }
    
    protected function create(Entity $entity)
    {
        $entity->id = md5(microtime());
        
        $this->entities[$entity->id] = $entity->toArray();
    }
    
    protected function update(Entity $entity)
    {
        if (!isset($this->entities[$entity->id])) {
            throw new Exception(get_class($entity) . ' does not exists, therefore it was not updated.');
        }
        
        $this->entities[$entity->id] = $entity->toArray();
    }
}