<?php

namespace Habitat;

/**
 * The cache driver interface.
 * 
 * @category Cache
 * @package  Habitat
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  Copyright (c) 2011 Trey Shugart http://europaphp.org/license
 */
interface CacheInterface
{
    /**
     * Returns a cached item.
     * 
     * @param string $key The cache key.
     * 
     * @return mixed
     */
    public function get($key);
    
    /**
     * Caches an item.
     * 
     * @param string $key      The cache key.
     * @param mixed  $value    The cached value.
     * @param mixed  $lifetime The max lifetime of the item in the cache.
     * 
     * @return \Habitat\CacheInterface
     */
    public function set($key, $value, $lifetime = null);
    
    /**
     * Checks to see if the specified cache item exists.
     * 
     * @param string $key The key to check for.
     * 
     * @return bool
     */
    public function exists($key);
    
    /**
     * Removes the item with the specified key.
     * 
     * @param string $key The key of the item to remove.
     * 
     * @return \Habitat\CacheInterface
     */
    public function remove($key);
}