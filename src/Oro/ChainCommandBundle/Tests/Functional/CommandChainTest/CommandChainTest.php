<?php

namespace ConsoleCommandChainBundle\Tests\Functional\CommandChainTest;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use ConsoleCommandChainBundle\Tests\Functional\CommandChainTest\Fixture\AppKernel;

class CommandChainTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $kernel = new AppKernel('test', false);

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(['command' => 'foo:hola']);
        $output = new BufferedOutput();
        $application->run($input, $output);

        $content = $output->fetch();

        $this->assertRegExp('/Hola from Foo/', $content);
        $this->assertRegExp('/Hola from Bar/', $content);
    }
}