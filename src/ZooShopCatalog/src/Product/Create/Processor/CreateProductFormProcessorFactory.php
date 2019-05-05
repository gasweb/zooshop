<?php
declare(strict_types=1);

namespace ZooShopCatalog\Product\Create\Processor;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CreateProductFormProcessorFactory
{
    public function __invoke(ContainerInterface $container) : CreateProductFormProcessor
    {
        return new CreateProductFormProcessor($container->get(TemplateRendererInterface::class));
    }
}
