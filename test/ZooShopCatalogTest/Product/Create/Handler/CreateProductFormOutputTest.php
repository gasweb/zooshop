<?php
declare(strict_types = 1);

namespace ZooShopCatalogTest\Product\Create\Handler;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopCatalog\Product\Create\Handler\CreateProductFormOutput;

class CreateProductFormOutputTest extends TestCase
{
    /** @var ContainerInterface|ObjectProphecy */
    protected $container;

    /** @var RouterInterface|ObjectProphecy */
    protected $router;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->router    = $this->prophesize(RouterInterface::class);
    }

    public function testReturnsHtmlResponseWhenTemplateRendererProvided()
    {
        $renderer = $this->prophesize(TemplateRendererInterface::class);
        $renderer
            ->render('product::create', Argument::type('array'))
            ->willReturn('');

        $createProductFormOutputHandler = new CreateProductFormOutput(
            $renderer->reveal()
        );

        $response = $createProductFormOutputHandler->handle(
            $this->prophesize(ServerRequestInterface::class)->reveal()
        );

        $this->assertInstanceOf(HtmlResponse::class, $response);
    }
}