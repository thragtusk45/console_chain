<?php

namespace Oro\ChainCommandBundle\Model;


use Symfony\Component\Console\Command\Command;

/**
 * Class CommandChain contains all the chain elements
 * @package Oro\ChainCommandBundle\Model
 * addCommand
 */
class CommandChain
{
    /**
     * @var string
     */
    protected $masterCommandName;
    /**
     * @var CommandBag
     */
    protected $commandBag;

    public function __construct($masterCommandName, $commands)
    {
        $this->masterCommandName = $masterCommandName;
        $this->commandBag = $commands;
    }

    /**
     * @param Command $command
     */
    public function addCommand(Command $command)
    {
        $this->commandBag[$command->getName()] = $command;
    }

    /**
     * @param $command
     * @return bool
     */
    public function hasCommand($command)
    {
        return $this->commandBag->has($command);
    }

    /**
     * @return string
     */
    public function getMasterCommandName()
    {
        return $this->masterCommandName;
    }

    /**
     * @param string $masterCommandName
     */
    public function setMasterCommandName($masterCommandName)
    {
        $this->masterCommandName = $masterCommandName;
    }

    /**
     * @return CommandBag
     */
    public function getCommandBag()
    {
        return $this->commandBag;
    }

    /**
     * @param CommandBag $commandBag
     */
    public function setCommandBag($commandBag)
    {
        $this->commandBag = $commandBag;
    }


}