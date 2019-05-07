<?php

declare(strict_types=1);

namespace ZooShopCatalog\Product\Create\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CreateProductFormOutputFactory
{
    public function __invoke(ContainerInterface $container) : CreateProductFormOutput
    {
        return new CreateProductFormOutput($container->get(TemplateRendererInterface::class));
    }
}
