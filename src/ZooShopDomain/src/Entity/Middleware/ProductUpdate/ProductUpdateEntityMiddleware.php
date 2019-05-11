<?php
declare(strict_types = 1);

namespace ZooShopDomain\Entity\Middleware\ProductUpdate;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ZooShopDomain\Entity\Product;
use Exception;

final class ProductUpdateEntityMiddleware implements MiddlewareInterface
{
    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    /**
     * ProductCreateMiddleware constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            /** @var Product $product */
            $product = $request->getAttribute(Product::class);
            $this->entityManager->persist($product);
            return $handler->handle($request->withAttribute(Product::class, $product));
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
