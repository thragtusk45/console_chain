<?php

namespace Oro\ChainCommandBundle\Model;

use Oro\ChainCommandBundle\Interfaces\CommandBagInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Class ChainBag
 * Container for the chains
 * @package Oro\ChainCommandBundle\Model
 * @author <amezhuev@gmail.com>
 */
class ChainBag implements CommandBagInterface
{
    /**
     * @var CommandChain[]
     */
    private $chains;

    /**
     * ChainBag constructor.
     */
    public function __construct()
    {
        $this->chains = [];
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
        return array_key_exists($key, $this->chains);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        return array_key_exists($key, $this->chains)
            ? $this->chains[$key]
            : null;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        if (!$this->has($key)) {
            $this->chains[$key] = new CommandChain($key, new CommandBag());
        }
        $this->chains[$key]->addCommand($value);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        unset($this->chains[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->chains;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->chains = [];
    }

    /**
     * @param Command $command
     * @return bool|CommandChain
     */
    public function hasCommand(Command $command)
    {
        foreach ($this->chains as $chain) {
            if ($chain->hasCommand($command->getName())) {
                return $chain;
            }
        }

        return false;
    }
}