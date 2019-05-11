<?php
declare(strict_types = 1);

namespace ZooShopDomain\Entity\Middleware\ProductUpdate\UpdateProductEntityByDTO;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ZooShopCatalog\Product\ProductDTO;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\Repository\GetProductById\GetProductById;

class UpdateProductEntityByDTO implements MiddlewareInterface
{
    /** @var GetProductById $getProductById */
    private $getProductById;

    public function __construct(GetProductById $getProductById)
    {
        $this->getProductById = $getProductById;
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
        /** @var ProductDTO $productDTO */
        $productDTO = $request->getAttribute(ProductDTO::class);

        /** @var Product $product */
        $product = $this->getProductById->__invoke(
            $productDTO->getId()
        );
        $product->updateFromDTO($productDTO);
        return $handler->handle($request->withAttribute(Product::class, $product));
    }
}