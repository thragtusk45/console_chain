<?php

namespace Oro\ChainCommandBundle\Service;

use Oro\ChainCommandBundle\Model\ChainBag;
use Oro\ChainCommandBundle\Model\CommandChain;
use Symfony\Component\Console\Command\Command;

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
     * @param Command $command
     * @param string $masterCommand
     */
    public function addCommandToChain(Command $command, $masterCommand)
    {
        $this->chains->set($masterCommand, $command);
    }

    /**
     * @param Command $command
     * @return bool|\Oro\ChainCommandBundle\Model\CommandChain
     */
    public function getChainByCommand(Command $command)
    {
        return $this->chains->hasCommand($command);
    }
}