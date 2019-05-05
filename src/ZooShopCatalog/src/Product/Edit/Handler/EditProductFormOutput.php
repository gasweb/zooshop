<?php

declare(strict_types=1);

namespace ZooShopCatalog\Product\Edit\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Handler\NotFoundHandler;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\Create\CreateForm;
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

    public function __construct(
        TemplateRendererInterface $renderer,
        GetProductById $getProductById
    ) {
        $this->renderer = $renderer;
        $this->getProductById = $getProductById;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            /** @var Product $product */
            $product = $this->getProductById->__invoke(new IdVO('165bbde0-6f73-11e9-a84f-80a589118d45'));
            $createForm = new CreateForm();
            $createForm->bind($product->createDTO());
            $createForm->prepare();
            return new HtmlResponse($this->renderer->render(
                'product::edit',
                [
                    'createForm' => $createForm
                ]
            ));
        } catch (ProductNotFoundException $productNotFoundException) {
            die('404');
        }
    }
}
