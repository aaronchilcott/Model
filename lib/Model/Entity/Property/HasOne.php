<?php

namespace Model\Entity\Property;
use Model\EntityAbstract;
use Model\Exception;

/**
 * A property that defines a one-to-one relationship with another entity.
 * 
 * @category Properties
 * @package  Model
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  Copyright (c) 2011 Trey Shugart http://europaphp.org/license
 */
class HasOne extends Base
{
    /**
     * The class name to use for the relationship.
     * 
     * @var string
     */
    protected $class;
    
    /**
     * Constructs a new relationship.
     * 
     * @param string $class The class to use for the relationship.
     * 
     * @return void
     */
    public function __construct($class)
    {
        $this->class = $class;
    }
    
    /**
     * Sets the relationship value.
     * 
     * @param mixed $value The value to set.
     * 
     * @return void
     */
    public function set($value)
    {
        $this->checkForClass();

        // instantiate
        $class = $this->class;
        $class = new $class($value);
        
        // make sure it's a valid instance
        if (!$class instanceof EntityAbstract) {
            throw new Exception(
                'The class "'
                . get_class($class)
                . '" must be a subclass of "\Model\EntityAbstract".'
            );
        }

        // and set
        $this->value = $class;
    }
    
    /**
     * Returns the relationship value.
     * 
     * @return \Model\EntityAbstract
     */
    public function get()
    {
        // then we can just return it
        return $this->value;
    }
    
    /**
     * Exports the relationship.
     * 
     * @return array
     */
    public function export()
    {
        // we only export if we have data to export
        if ($value = $this->get()) {
            return $value->export();
        }
        return array();
    }
    
    /**
     * Makes sure the specified class is a valid instance.
     * 
     * @throws Model_Exception If it is not a valid instance.
     * 
     * @return void
     */
    protected function checkForClass()
    {
        // make sure a proper class was set
        if (!isset($this->class)) {
            throw new Exception(
                'Cannot instantiate has-one relationship for "'
                . get_class($this->entity)
                . '" because "class" was not defined in the "data" array.'
            );
        }
    }
}