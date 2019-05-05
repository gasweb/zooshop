<?php
declare(strict_types = 1);

namespace ZooShopDomain\Repository\GetProductById;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class GetProductByIdFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return GetProductById
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new GetProductById(
            $container->get('doctrine.entity_manager.orm_shop')
        );
    }
}