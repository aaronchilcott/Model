<?php

namespace Model\Configurator\DocComment;
use Closure;
use Model\Entity\Entity;
use Reflector;
use UnexpectedValueException;

/**
 * Uses doc comments to configure an entity.
 * 
 * @category Configurators
 * @package  Model
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  http://europaphp.org/license
 */
class VarTag implements DocTagInterface
{
    /**
     * Configures the entity with the specified VO.
     * 
     * @param string    $value  The doc tag string minus the tag name.
     * @param Reflector $refl   The property to configure.
     * @param Entity    $entity The entity being configured.
     * 
     * @return Vo
     */
    public function configure($value, Reflector $refl, Entity $entity)
    {
        // the first part of the var tag is the var type (VO instance class name)
        // the second part is an evaluated set of arguments to pass to the constructor of the VO
        $parts = explode(' ', $value, 2);
        
        // the class is retrieved using a closure so that we can bind a scope to it
        $class = function() use ($parts) {
            if (isset($parts[1])) {
                $class = eval('return new ' . $parts[0] . '(' . $parts[1] . ');');
            } else {
                $class = new $parts[0];
            }
            return $class;
        };
        
        // bind the closure to the entity context
        $class = $class->bindTo($entity);
        
        // get the VO instance
        $class = $class();
        
        // apply the vo
        $entity->setVo($refl->getName(), $class);
        
        // set the default value if it exists
        $this->setDefaultValueIfExists($entity, $refl);
    }
    
    /**
     * Sets the default value for the VO that is specified in the property definition.
     * 
     * @param Entity    $entity The entity to set the default value of.
     * @param Reflector $refl   The property with a potential default value.
     * 
     * @return void
     */
    private function setDefaultValueIfExists(Entity $entity, Reflector $refl)
    {
        $name = $refl->getName();
        $prop = $refl->getDeclaringClass()->getDefaultProperties();
        if (isset($prop[$name])) {
            $entity->__set($name, $prop[$name]);
        }
    }
}