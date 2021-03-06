<?php

namespace Oro\BarBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ByeCommand
 * @package Oro\BarBundle\Command
 * @author <amezhuev@gmail.com>
 */
class ByeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('bar:bye')
            ->setDescription('Says Bye');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Bye!');
    }
}