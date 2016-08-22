<?php

namespace Oro\ChainCommandBundle\Tests\Functional\CommandChainTest;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Tester\ApplicationTester;

/**
 * Class CommandChainTest
 * @package ConsoleCommandChainBundle\Tests\Functional\CommandChainTest
 * @author Alexey Mezhuev <a.mezhuev@bikeportal.in>
 */
class CommandChainTest extends KernelTestCase
{

    /**
     * Tests
     * @throws \Exception
     */
    public function testPositive()
    {
        static::bootKernel();
        $application = new Application(static::$kernel);
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);

        $command = ['command' => 'foo:hello'];
        $tester->run($command);
        $output = $tester->getDisplay();


        $this->assertRegExp('/Hello from Foo/', $output);
        $this->assertRegExp('/Hi from Bar/', $output);
    }

    public function testNegative()
    {
        static::bootKernel();
        $application = new Application(static::$kernel);
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $command = ['command' => 'bar:hi'];
        $tester->run($command);
        $output = $tester->getDisplay();

        $this->assertRegExp('/bar:hi command is a member of foo:hello command chain and cannot be executed on its own./', $output);
    }
}