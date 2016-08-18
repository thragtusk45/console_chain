<?php

namespace Oro\ChainCommandBundle\Model;


use Oro\ChainCommandBundle\Interfaces\CommandBagInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Class CommandBag
 * Container for commands
 * @package Oro\ChainCommandBundle\Model
 * @author Alexey Mezhuev <a.mezhuev@bikeportal.in>
 */
class CommandBag implements CommandBagInterface
{
    /**
     * @var Command[]
     */
    private $commands;

    /**
     * CommandBag constructor.
     */
    public function __construct()
    {
        $this->commands = [];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return array_key_exists($key, $this->commands);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        return array_key_exists($key, $this->commands)
            ? $this->commands[$key]
            : null;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
       $this->commands[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        unset($this->commands[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->commands;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->commands = [];
    }

}