<?php

namespace Oro\ChainCommandBundle\Service;

use Oro\ChainCommandBundle\Model\ChainBag;
use Oro\ChainCommandBundle\Model\CommandChain;

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