<?php

namespace Oro\ChainCommandBundle\EventListner;

use Oro\ChainCommandBundle\Model\CommandChain;
use Oro\ChainCommandBundle\Service\ChainCommandManagerService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Class CommandChainListener
 * Listens to all commands and processes  the chains
 * @package Oro\ChainCommandBundle\EventListner
 * @author <amezhuev@gmail.com>
 */
class ChainCommandListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ChainCommandManagerService
     */
    private $chainManager;

    public function __construct(LoggerInterface $logger, ChainCommandManagerService $chainManager)
    {
        $this->logger = $logger;
        $this->chainManager = $chainManager;
    }

    /**
     * @param ConsoleCommandEvent $event
     * @throws \Exception
     * @throws \Symfony\Component\Console\Exception\ExceptionInterface
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        $command = $event->getCommand();
        $commandChain = $this->chainManager->getChainByCommand($command);

        if ($this->isChainMember($command)) {
            throw new \Exception($command->getName() . ' command is a member of ' .
                $commandChain->getMasterCommandName() .' command chain and cannot be executed on its own.');
        }

        $chain = $this->chainManager->getChain($command->getName());

        if ($chain) {
            $event->disableCommand();
            $this->logger->info($chain->getMasterCommandName() .
                ' is a master command of a command chain that has registered member commands');

            foreach ($chain->getCommandBag()->toArray() as $memberCommand) {
                $this->logger->info($memberCommand->getName() . ' registered as a member of ' .
                    $chain->getMasterCommandName() . ' command chain');
            }

            $this->logger->info('Executing ' . $chain->getMasterCommandName() . ' command itself first:');
            $command->run($event->getInput(), $event->getOutput());

            $this->logger->info('Executing ' . $chain->getMasterCommandName() . ' chain members:');
            $this->executeChain($chain, $event);
            $this->logger->info('Executing of ' . $chain->getMasterCommandName() . ' chain completed.');
        }
    }

    /**
     * Checks if a command is a member of a chain
     * @param Command $command
     * @throws \Exception
     */
    private function isChainMember(Command $command)
    {
        $commandChain = $this->chainManager->getChainByCommand($command);

        if ($commandChain !== false) {
            return true;
        }

        return false;
    }

    /**
     * Executes the command chain
     * @param CommandChain $chain
     * @param ConsoleCommandEvent $event
     * @throws \Symfony\Component\Console\Exception\ExceptionInterface
     */
    private function executeChain(CommandChain $chain, ConsoleCommandEvent $event)
    {
        foreach ($chain->getCommandBag()->toArray() as $memberCommand) {
            $memberCommand->run(new ArrayInput([]), $event->getOutput());
        }

    }

}