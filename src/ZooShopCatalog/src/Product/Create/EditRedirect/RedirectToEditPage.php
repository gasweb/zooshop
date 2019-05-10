<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product\Create\EditRedirect;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use ZooShopApp\ConfigProvider;
use ZooShopDomain\Entity\Product;

class RedirectToEditPage implements MiddlewareInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var Product $product */
        $product = $request->getAttribute(Product::class);
        return new RedirectResponse($this->router->generateUri(
            ConfigProvider::PRODUCT_EDIT['alias'],
            [
               Product::ID => $product->getId()
            ]
        ));
    }
}
