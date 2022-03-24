<?php

namespace BenTools\UserAwareCommandBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('user_aware_command');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode->children()
            ->scalarNode('user_name')->defaultValue('System')->cannotBeEmpty()->end()
            ->scalarNode('option_name')->defaultValue('user')->cannotBeEmpty()->end()
            ->scalarNode('option_shortcut')->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
