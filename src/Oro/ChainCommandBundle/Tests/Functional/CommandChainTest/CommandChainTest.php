<?php

namespace Oro\ChainCommandBundle\Tests\Functional\CommandChainTest;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CommandChainTest
 * Tried to do this via ApplicationTester for 3 days, then i just gave up
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
        exec('php app/console foo:hello', $output);
        $output = implode(' ',$output);
        $this->assertRegExp('/Hello from Foo/', $output);
        $this->assertRegExp('/Hi from Bar/', $output);
    }

    public function testNegative()
    {
        exec('php app/console bar:hi 2>&1', $output);
        $output = implode(' ',$output);

        $this->assertRegExp('/bar:hi command is a member of foo:hello command chain and cannot be executed on its own./', $output);
    }
}