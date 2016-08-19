<?php
use \Oro\ChainCommandBundle\Model\CommandChain;
use \Oro\ChainCommandBundle\Service\ChainCommandManagerService;
use \Symfony\Component\Console\Application;
use \Oro\ChainCommandBundle\Model\CommandBag;
/**
 * Class ChainCommandManagerTest
 * Test creation n
 */
class ChainCommandManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateChain()
    {
        $chainManager = new ChainCommandManagerService();
        $application = new Application();
        $command = $application->find('bar:bye');
        $chainManager->addCommandToChain($command, 'bar:hello');

        $chain = $chainManager->getChain('foo:hello');

        $this->assertInstanceOf(CommandChain::class, $chain);
        $this->assertEquals('foo:hello', $chain->getMasterCommandName());
    }

    public function testAddCommandToChainAndChainSearch()
    {
        $chainManager = new ChainCommandManagerService();
        $application = new Application();
        $byeCommand = $application->find('bar:bye');
        $chainManager->addCommandToChain($byeCommand, 'bar:hello');

        $this->assertEmpty($chainManager->getChain('bar:hello')->getCommandBag());
        $this->assertInstanceOf(CommandChain::class, $chainManager->getChainByCommand($byeCommand));
        $standaloneCommand = $application->find('foo:standalone');
        $chainManager->addCommandToChain($standaloneCommand, 'bar:hello');
        $chain = $chainManager->getChainByCommand($standaloneCommand);

        $this->assertInstanceOf(CommandChain::class, $chain);
        $bag = new CommandBag([]);
        $bag->set($byeCommand->getName(), $byeCommand);
        $bag->set($standaloneCommand->getName(), $standaloneCommand);
        $this->assertEquals($bag, $chain->getCommandBag());
    }
}