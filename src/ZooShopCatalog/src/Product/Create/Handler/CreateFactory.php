<?php

declare(strict_types=1);

namespace ZooShopCatalog\Product\Create\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CreateFactory
{
    public function __invoke(ContainerInterface $container) : Create
    {
        return new Create($container->get(TemplateRendererInterface::class));
    }
}
