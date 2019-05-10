<?php

declare(strict_types=1);

namespace ZooShopCatalog\Product\Edit\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopDomain\Repository\GetProductById\GetProductById;

class EditProductFormOutputFactory
{
    public function __invoke(ContainerInterface $container) : EditProductFormOutput
    {
        return new EditProductFormOutput(
            $container->get(TemplateRendererInterface::class),
            $container->get(GetProductById::class),
            $container->get(RouterInterface::class)
        );
    }
}
