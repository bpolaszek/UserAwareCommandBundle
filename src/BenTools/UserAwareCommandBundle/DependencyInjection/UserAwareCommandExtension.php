<?php

namespace BenTools\UserAwareCommandBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class UserAwareCommandExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $definition = $container->getDefinition('user_aware_command.command_listener');

        if (isset($config['user_name'])) {
            $definition->addMethodCall('setUserValue', [$config['user_name']]);
        }

        if (isset($config['option_name'])) {
            $definition->addMethodCall('setOptionName', [$config['option_name']]);
        }

        if (isset($config['option_shortcut'])) {
            $definition->addMethodCall('setOptionShortcut', [$config['option_shortcut']]);
        }
    }
}
