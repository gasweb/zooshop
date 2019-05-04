<?php

declare(strict_types=1);

namespace ZooShopCatalog\Product\Create\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\Create\CreateForm;

class Create implements RequestHandlerInterface
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
        $form = new CreateForm();
//        $form->setAttribute('action', ConfigProvider::PRODUCT_CREATE['route']);
        $form->prepare();
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'product::create',
            [
                'form' => $form
            ] // parameters to pass to template
        ));
    }
}
