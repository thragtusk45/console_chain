<?php

namespace Oro\ChainCommandBundle\Model;


use Oro\ChainCommandBundle\Interfaces\CommandBagInterface;
use Symfony\Component\Console\Command\Command;

class CommandChain
{
    /**
     * @var string
     */
    protected $masterCommand;
    /**
     * @var array
     */
    protected $commands;

    public function __construct($masterCommand, $commands)
    {
        $this->masterCommand = $masterCommand;
        $this->commands = $commands;
    }

    public function addCommand($command)
    {
        $this->commands[] = $command;
    }

}