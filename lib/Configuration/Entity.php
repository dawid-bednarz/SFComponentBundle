<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Configuration;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Entity
{
    private $nodeBuilder;

    function __construct(ArrayNodeDefinition $rootNode)
    {
        $this->nodeBuilder = $rootNode
            ->children()
            ->arrayNode('entities')
            ->isRequired()
            ->children();
    }

    public function new(string $name, string $class): Entity
    {
        $this->nodeBuilder
            ->scalarNode($name)
            ->cannotBeEmpty()
            ->isRequired()
            ->validate()
            ->ifTrue(function ($v) {
                return !class_exists($v);
            })
            ->thenInvalid($name . ' entity not exists')
            ->ifTrue(function ($v) use ($class) {
                return !is_subclass_of($v, $class);
            })
            ->thenInvalid($name . ' must implements ' . $class);

        return $this;
    }

    public function end() : void
    {
        $this->nodeBuilder
            ->end()
            ->end();
    }

    function __call($name, $arguments)
    {
        return $this->nodeBuilder->$name(...$arguments);
    }
}