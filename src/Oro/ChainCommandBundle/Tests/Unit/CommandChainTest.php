<?php
use \Symfony\Component\Console\Application;
use \Oro\ChainCommandBundle\Model\CommandChain;
use \Oro\ChainCommandBundle\Model\CommandBag;
/**
 * Class CommandChainTest
 */
class CommandChainTest extends PHPUnit_Framework_TestCase
{
    public function testCreateChain()
    {
        $application = new Application();
        $application->addCommands([
            new \Oro\BarBundle\Command\HiCommand(),
            new \Oro\FooBundle\Command\HelloCommand(),
        ]);
        $hiCommand = $application->find('bar:hi');
        $helloCommand = $application->find('foo:hello');
        $bag = new CommandBag([]);
        $bag->set($hiCommand->getName(), $hiCommand);
        $chain = new CommandChain($helloCommand, $bag);

        $this->assertInstanceOf(CommandChain::class, $chain);
        $this->assertNotEmpty($chain->getCommandBag());
    }

    public function testAddCommand()
    {
        $application = new Application();
        $application->addCommands([
            new \Oro\BarBundle\Command\HiCommand(),
            new \Oro\FooBundle\Command\HelloCommand(),
        ]);
        $hiCommand = $application->find('bar:hi');
        $helloCommand = $application->find('foo:hello');
        $bag = new CommandBag([$hiCommand]);
        $chain = new CommandChain($helloCommand,  new CommandBag([]));
        $chain->addCommand($hiCommand);
        $this->assertEquals($bag, $chain->getCommandBag());
    }

}