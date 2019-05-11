<?php
namespace ZooShopDomain\Entity\Middleware\ProductUpdate;

use Interop\Container\ContainerInterface;
use ZooShopDomain\Repository\GetProductById\GetProductById;
use ZooShopDomain\Repository\ProductCreateRepository\ProductCreateCreateRepository;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProductUpdateEntityMiddlewareFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ProductUpdateEntityMiddleware(
            $container->get('doctrine.entity_manager.orm_shop')
        );
    }
}
