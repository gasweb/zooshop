<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product\Create\EditRedirect;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RedirectToEditPageFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return RedirectToEditPage
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new RedirectToEditPage(
            $container->get(RouterInterface::class)
        );
    }
}