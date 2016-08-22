<?php

namespace Oro\FooBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class HelloCommand
 * Says hello from foo
 * @package Oro\FooBundle\Command
 * @author Alexey Mezhuev <a.mezhuev@bikeportal.in>
 */
class HelloCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('foo:hello')
            ->setDescription('Says hello from foo');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello from Foo!');
    }
}