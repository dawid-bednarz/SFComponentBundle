<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    const NODE_DEBUG_EVENT_COMMANDS = 'debug_event_commands';

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder;
        $rootNode = $treeBuilder->root('dawbed_component_bundle');

        $rootNode
            ->children()
            ->arrayNode(self::NODE_DEBUG_EVENT_COMMANDS)
            ->scalarPrototype()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}