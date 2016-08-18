<?php

namespace Oro\ChainCommandBundle\Service;

use Oro\ChainCommandBundle\Model\ChainBag;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class ChainCommandManagerService
{
    /**
     * @var ChainBag
     */
    protected $chains;

    /**
     * @param string $masterCommandName
     * @return null|string
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
}