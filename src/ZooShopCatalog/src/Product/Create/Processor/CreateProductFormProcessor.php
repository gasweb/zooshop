<?php
declare(strict_types=1);

namespace ZooShopCatalog\Product\Create\Processor;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\Create\CreateForm;
use ZooShopCatalog\Product\ProductDTO;

class CreateProductFormProcessor implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
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


    }
}
