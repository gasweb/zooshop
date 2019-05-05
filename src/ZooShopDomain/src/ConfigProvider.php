<?php

declare(strict_types=1);

namespace ZooShopDomain;

use ZooShopDomain\Entity\Manager\FlushMiddleware\FlushMiddleware;
use ZooShopDomain\Entity\Manager\FlushMiddleware\FlushMiddlewareFactory;
use ZooShopDomain\Entity\Middleware\ProductCreate\ProductCreateEntityMiddlewareFactory;
use ZooShopDomain\Entity\Middleware\ProductCreate\ProductCreateEntityMiddleware;
use ZooShopDomain\Repository\GetProductById\GetProductById;
use ZooShopDomain\Repository\GetProductById\GetProductByIdFactory;

/**
 * The configuration provider for the ZooShopDomain module
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
                ProductCreateEntityMiddleware::class => ProductCreateEntityMiddlewareFactory::class,
                FlushMiddleware::class => FlushMiddlewareFactory::class,
                GetProductById::class => GetProductByIdFactory::class
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
                'zoo-shop-domain'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
