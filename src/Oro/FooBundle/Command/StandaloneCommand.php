<?php

namespace Oro\FooBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StandaloneCommand
 * @package Oro\FooBundle\Command
 * @author <amezhuev@gmail.com>
 */
class StandaloneCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('foo:standalone')
            ->setDescription('Stands alone');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('I stand alone!');
    }
}