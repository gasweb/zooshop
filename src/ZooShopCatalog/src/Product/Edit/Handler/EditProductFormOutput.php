<?php

declare(strict_types=1);

namespace ZooShopCatalog\Product\Edit\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Handler\NotFoundHandler;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\Create\CreateForm;
use ZooShopCatalog\Product\Edit\EditForm;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\Exceptions\Product\ProductNotFoundException;
use ZooShopDomain\Repository\GetProductById\GetProductById;
use ZooShopDomain\ValueObjects\Id\IdVO;

class EditProductFormOutput implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /** @var GetProductById $getProductById */
    private $getProductById;

    /** @var RouterInterface $router */
    private $router;

    public function __construct(
        TemplateRendererInterface $renderer,
        GetProductById $getProductById,
        RouterInterface $router
    ) {
        $this->renderer = $renderer;
        $this->getProductById = $getProductById;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            /** @var Product $product */
            $product = $this->getProductById->__invoke(
                IdVO::create(
                    $request->getAttribute(IdVO::NAME)
                )
            );
            $editForm = new EditForm();
            $editForm->setAttribute('action', $this->router->generateUri(
                ConfigProvider::PRODUCT_CREATE_PROCESSOR['alias'],
                [
                    Product::ID => $product->getId()
                ]
            ));
            $editForm->bind($product->createDTO());
            $editForm->prepare();
            return new HtmlResponse($this->renderer->render(
                'product::edit',
                [
                    'editForm' => $editForm
                ]
            ));
        } catch (ProductNotFoundException $productNotFoundException) {
            die('404');
        }
    }
}
