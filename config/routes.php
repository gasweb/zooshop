<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;
use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\Create\Processor\CreateProductFormProcessor;
use ZooShopCatalog\Product\Create\Handler\CreateProductFormOutput;
use ZooShopCatalog\Product\Edit\Handler\EditProductFormOutput;
use ZooShopDomain\Entity\Middleware\ProductCreate\ProductCreateEntityMiddleware;
use ZooShopDomain\Entity\Manager\FlushMiddleware\FlushMiddleware;
use ZooShopCatalog\Product\Create\EditRedirect\RedirectToEditPage;
use ZooShopCatalog\Product\Edit\Processor\EditProductFormProcessor;
use ZooShopDomain\Entity\Middleware\ProductUpdate\ProductUpdateEntityMiddleware;
use ZooShopDomain\Entity\Middleware\ProductUpdate\UpdateProductEntityByDTO\UpdateProductEntityByDTO;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get(
        ConfigProvider::PRODUCT_CREATE['route'],
        [
            CreateProductFormOutput::class
        ],
        ConfigProvider::PRODUCT_CREATE['alias']
    );
    $app->post(
        ConfigProvider::PRODUCT_CREATE_PROCESSOR['route'],
        [
            CreateProductFormProcessor::class,
            ProductCreateEntityMiddleware::class,
            FlushMiddleware::class,
            RedirectToEditPage::class
        ],
        ConfigProvider::PRODUCT_CREATE_PROCESSOR['alias']
    );
    $app->get(
        ConfigProvider::PRODUCT_EDIT['route'],
        [
            EditProductFormOutput::class
        ],
        ConfigProvider::PRODUCT_EDIT['alias']
    );
    $app->post(
        ConfigProvider::PRODUCT_EDIT_PROCESSOR['route'],
        [
            EditProductFormProcessor::class,
            UpdateProductEntityByDTO::class,
            ProductUpdateEntityMiddleware::class,
            FlushMiddleware::class,
            RedirectToEditPage::class
        ],
        ConfigProvider::PRODUCT_EDIT_PROCESSOR['alias']
    );
};
