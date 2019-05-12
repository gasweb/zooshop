<?php
declare(strict_types = 1);

namespace ZooShopCatalogTest\Product\Create\Handler;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopCatalog\Product\Create\Handler\CreateProductFormOutput;
use ZooShopCatalog\Product\Create\Handler\CreateProductFormOutputFactory;

class CreateProductFormOutputFactoryTest extends TestCase
{
    /** @var ContainerInterface|ObjectProphecy */
    protected $container;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $router = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
    }

    public function testFactoryWithTemplate()
    {
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));

        $factory = new CreateProductFormOutputFactory();

        $createProductFormOutputHandler = $factory($this->container->reveal());

        $this->assertInstanceOf(CreateProductFormOutput::class, $createProductFormOutputHandler);
    }
}