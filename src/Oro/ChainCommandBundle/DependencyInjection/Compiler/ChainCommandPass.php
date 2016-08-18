<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 13.08.2016
 * Time: 22:12
 */

namespace Oro\ChainCommandBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ChainCommandPass
 * Works with the command_chain tag
 * adds commands to their tagged masterCommands
 * @package Oro\ChainCommandBundle\DependencyInjection\Compiler
 * @author <amezhuev@gmail.com>
 */
class ChainCommandPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('oro_chain_command.chain_command_manager')) {
            return;
        }

        $definition = $container->findDefinition('oro_chain_command.chain_command_manager');

        $taggedServices = $container->findTaggedServiceIds('oro_chain_command.command_chain.member');
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addCommandToChain', [new Reference($id), $attributes['command_chain']]);
            }

        }
    }
}