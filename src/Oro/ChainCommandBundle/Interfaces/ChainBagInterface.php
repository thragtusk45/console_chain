<?php
namespace Oro\ChainCommandBundle\Interfaces;


use Oro\ChainCommandBundle\Model\CommandChain;
use Symfony\Component\Console\Command\Command;

/**
 * Interface ChainBagInterface
 * Array access for the chain container
 * @package Oro\ChainCommandBundle\Interfaces
 * @author Alexey Mezhuev <a.mezhuev@bikeportal.in>
 */
interface ChainBagInterface extends \ArrayAccess
{
    /**
     * Get a chain by name
     * @param string $key
     * @return CommandChain
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
     * @param Command $key
     * @return void
     */
    public function remove($key);

}