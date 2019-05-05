<?php

declare(strict_types=1);

namespace ZooShopCatalog;

use ZooShopCatalog\Product\Create\Handler\Create;
use ZooShopCatalog\Product\Create\Handler\CreateFactory;
use ZooShopCatalog\Product\Create\Processor\Processor;
use ZooShopCatalog\Product\Create\Processor\ProcessorFactory;

/**
 * The configuration provider for the ZooShopCatalog module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                Create::class => CreateFactory::class,
                Processor::class => ProcessorFactory::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'product'    => [__DIR__ . '/../templates/product'],
            ],
        ];
    }
}
