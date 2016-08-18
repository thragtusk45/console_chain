<?php

namespace Oro\ChainCommandBundle;

use Oro\ChainCommandBundle\DependencyInjection\Compiler\ChainCommandPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OroChainCommandBundle extends Bundle
{
    /**
     * Register the compiler pass
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ChainCommandPass());
    }
}
