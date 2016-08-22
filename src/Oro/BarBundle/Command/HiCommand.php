<?php

namespace Oro\BarBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HiCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('bar:hi')
            ->setDescription('Says Hi from Bar');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hi from Bar!');
    }
}