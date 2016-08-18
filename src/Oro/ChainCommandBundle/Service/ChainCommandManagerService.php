<?php

namespace Oro\ChainCommandBundle\Service;

use Oro\ChainCommandBundle\Model\ChainBag;
use Oro\ChainCommandBundle\Model\CommandChain;

/**
 * Class ChainCommandManagerService
 * Manages all the registered chains
 * @package Oro\ChainCommandBundle\Service
 * @author Alexey Mezhuev <a.mezhuev@bikeportal.in>
 */
class ChainCommandManagerService
{
    /**
     * @var ChainBag
     */
    protected $chains;

    public function __construct()
    {
        $this->chains = new ChainBag();
    }

    /**
     * @param string $masterCommandName
     * @return null|CommandChain
     */
    public function getChain($masterCommandName)
    {
        if ($this->chains->has($masterCommandName)) {
            return $this->chains->get($masterCommandName);
        }

        return null;
    }

    /**
     * @param string $command
     * @param string $masterCommand
     */
    public function addCommandToChain($command, $masterCommand)
    {
        $this->chains->set($masterCommand, $command);
    }

    /**
     * @param $command
     * @return bool|\Oro\ChainCommandBundle\Model\CommandChain
     */
    public function getChainByCommand($command)
    {
        return $this->chains->hasCommand($command);
    }
}