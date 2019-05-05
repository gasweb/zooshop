<?php
declare(strict_types=1);

namespace ZooShopCatalog\Product\Create\Processor;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopCatalog\Product\Create\CreateForm;
use ZooShopCatalog\Product\ProductDTO;

class CreateProductFormProcessor implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
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
        $productDTO = new ProductDTO();
        $createForm = new CreateForm();
        $createForm->bind($productDTO);
        $createForm->setData($request->getParsedBody());
        if (!$createForm->isValid()) {
            return new HtmlResponse($this->renderer->render(
                'product::create',
                [
                    'createForm' => $createForm
                ]
            ));
        }
        return $handler->handle(
            $request->withAttribute(ProductDTO::class, $productDTO)
        );
    }
}
