<?php

namespace Oro\ChainCommandBundle\Model;

use Oro\ChainCommandBundle\Interfaces\CommandBagInterface;

/**
 * Class ChainBag
 * @package Oro\ChainCommandBundle\Model
 * @author <amezhuev@gmail.com>
 */
class ChainBag implements CommandBagInterface
{
    /**
     * @var array
     */
    private $chains;

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
        $this->chains[$key] = $value;
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
}