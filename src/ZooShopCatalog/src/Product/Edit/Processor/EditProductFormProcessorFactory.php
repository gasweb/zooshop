<?php
declare(strict_types=1);

namespace ZooShopCatalog\Product\Edit\Processor;

use Interop\Container\Exception\ContainerException;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZooShopCatalog\Product\Edit\Processor\EditProductFormProcessor;

class EditProductFormProcessorFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param \Interop\Container\ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        return new EditProductFormProcessor(
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class)
        );
    }
}
