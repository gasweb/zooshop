<?php

declare(strict_types=1);

namespace ZooShopApp;

/**
 * The configuration provider for the ZooShopApp module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    const PRODUCT_CREATE = [
        'route' => '/admin/product/add',
        'alias' => 'admin.product.add'
    ];
    const PRODUCT_EDIT = [
        'route' => '/admin/product/edit/:id',
        'alias' => 'admin.product.edit'
    ];

    const PRODUCT_CREATE_PROCESSOR = [
        'route' => '/admin/product/add',
        'alias' => 'post.admin.product.add'
    ];

    const PRODUCT_EDIT_PROCESSOR = [
        'route' => '/admin/product/edit/:id',
        'alias' => 'post.admin.product.edit'
    ];

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
                'app-partial'    => [__DIR__ . '/../templates/partial'],
                'zoo-shop-app'    => [__DIR__ . '/../templates/'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
