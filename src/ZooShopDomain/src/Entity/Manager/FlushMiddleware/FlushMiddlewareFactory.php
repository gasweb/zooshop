<?php
namespace ZooShopDomain\Entity\Manager\FlushMiddleware;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class FlushMiddlewareFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return FlushMiddleware
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new FlushMiddleware(
            $container->get('doctrine.entity_manager.orm_shop')
        );
    }
}
