<?php
declare(strict_types=1);

namespace ZooShopCatalog\Product\Edit\Processor;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\Create\CreateForm;
use ZooShopCatalog\Product\Edit\EditForm;
use ZooShopCatalog\Product\ProductDTO;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Id\IdVO;

class EditProductFormProcessor implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /** @var RouterInterface $router */
    private $router;

    public function __construct(TemplateRendererInterface $renderer, RouterInterface $router)
    {
        $this->renderer = $renderer;
        $this->router = $router;
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
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $pageURI = $this->router->generateUri(
            ConfigProvider::PRODUCT_EDIT['alias'],
            [
                Product::ID => $request->getAttribute(Product::ID)
            ]
        );
        $productDTO = new ProductDTO(
            IdVO::create(
                $request->getAttribute(Product::ID)
            )
        );
        $editForm = new EditForm();
        $editForm->bind($productDTO);
        $editForm->setData($request->getParsedBody());
        $editForm->setAttribute('action', $pageURI);
        if (!$editForm->isValid()) {
            return new HtmlResponse($this->renderer->render(
                'product::edit',
                [
                    'editForm' => $editForm
                ]
            ));
        }
        return $handler->handle(
            $request->withAttribute(ProductDTO::class, $productDTO)
        );
    }
}
