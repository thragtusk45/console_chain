<?php

namespace Oro\ChainCommandBundle\EventListner;

use Oro\ChainCommandBundle\Service\ChainCommandManagerService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;

/**
 * Class CommandChainListener
 * @package Oro\ChainCommandBundle\EventListner
 * @author <amezhuev@gmail.com>
 */
class ChainCommandListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ChainCommandManagerService
     */
    private $chainManager;

    public function __construct(LoggerInterface $logger, ChainCommandManagerService $chainManager)
    {
        $this->logger = $logger;
        $this->chainManager = $chainManager;
    }

    public function onConsoleCommand(ConsoleCommandEvent $event)
    {

    }
}