<?php
namespace ZooShopDomain\Entity\Middleware\ProductCreate;

use Interop\Container\ContainerInterface;
use ZooShopDomain\Repository\ProductCreateRepository\ProductCreateCreateRepository;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProductCreateEntityMiddlewareFactory implements FactoryInterface
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
        return new ProductCreateEntityMiddleware(
            $container->get('doctrine.entity_manager.orm_shop')
        );
    }
}
