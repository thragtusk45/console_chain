<?php

namespace Oro\ChainCommandBundle\Interfaces;

/**
 * Interface CommandBagInterface
 * Array Access for the bag container
 * @package Oro\ChainCommandBundle\Interfaces
 * @author <amezhuev@gmail.com>
 */
interface CommandBagInterface extends \ArrayAccess
{
    /**
     * Get a chain by name
     * @param string $key
     * @return string
     */
    public function get($key);

    /**
     * Sets a chain with given master command
     * If it doesn't exist created it
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * Has a chain with the following master command
     * @param string $key
     * @return boolean
     */
    public function has($key);

    /**
     * Deletes a chain with the following master command
     * @param string $key
     * @return void
     */
    public function remove($key);
}