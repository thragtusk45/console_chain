<?php
use \Oro\ChainCommandBundle\Model\CommandChain;
use \Oro\ChainCommandBundle\Service\ChainCommandManagerService;
use \Symfony\Component\Console\Application;
use \Oro\ChainCommandBundle\Model\CommandBag;
/**
 * Class ChainCommandManagerTest
 * @author Alexey Mezhuev <a.mezhuev@bikeportal.in>
 */
class ChainCommandManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the chain creation
     */
    public function testCreateChain()
    {
        $chainManager = new ChainCommandManagerService();
        $application = new Application();
        $application->addCommands([
            new \Oro\BarBundle\Command\HiCommand(),
            new \Oro\FooBundle\Command\HelloCommand()
        ]);
        $command = $application->find('bar:hi');
        $chainManager->addCommandToChain($command, 'foo:hello');

        $chain = $chainManager->getChain('foo:hello');

        $this->assertInstanceOf(CommandChain::class, $chain);
        $this->assertEquals('foo:hello', $chain->getMasterCommandName());
    }

    /**
     * Test single and multiple addition
     */
    public function testAddCommandToChain()
    {
        $chainManager = new ChainCommandManagerService();
        $application = new Application();
        $application->addCommands([
            new \Oro\BarBundle\Command\HiCommand(),
            new \Oro\FooBundle\Command\HelloCommand(),
            new \Oro\FooBundle\Command\StandaloneCommand(),
        ]);
        $hiCommand = $application->find('bar:hi');
        $standaloneCommand = $application->find('foo:standalone');

        $chainManager->addCommandToChain($hiCommand, 'foo:hello');
        $this->assertNotEmpty($chainManager->getChain('foo:hello')->getCommandBag());

        $chainManager->addCommandToChain($standaloneCommand, 'foo:hello');
        $chain = $chainManager->getChainByCommand($standaloneCommand);
        $bag = new CommandBag([]);
        $bag->set($hiCommand->getName(), $hiCommand);
        $bag->set($standaloneCommand->getName(), $standaloneCommand);

        $this->assertEquals($bag, $chain->getCommandBag());

    }

    /**
     * Test chain search by command
     */
    public function testChainSearch()
    {
        $chainManager = new ChainCommandManagerService();
        $application = new Application();
        $application->addCommands([
            new \Oro\BarBundle\Command\HiCommand(),
            new \Oro\FooBundle\Command\HelloCommand(),
        ]);

        $HiCommand = $application->find('bar:hi');
        $chainManager->addCommandToChain($HiCommand, 'foo:hello');

        $this->assertInstanceOf(CommandChain::class, $chainManager->getChainByCommand($HiCommand));
        $this->assertInstanceOf(CommandChain::class, $chainManager->getChain('foo:hello'));


    }
}