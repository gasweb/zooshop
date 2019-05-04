<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product\Create;

use Zend\Form\Element\Text;
use Zend\Form\Form;
use ZooShopApp\ConfigProvider;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Title\TitleVO;

class CreateForm extends Form
{
    protected $attributes = [
        'method' => 'POST',
        'action' => ConfigProvider::PRODUCT_CREATE['route']
    ];

    const TITLE_LABEL = 'CREATE_PRODUCT_FORM_TITLE_LABEL';
    const TITLE_PLACEHOLDER= 'CREATE_PRODUCT_FORM_TITLE_PLACEHOLDER';

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->addTitle();
    }

    private function addTitle()
    {
        $this->add([
            'name' => Product::TITLE,
            'type' => Text::class,
            'options' => [
                'property' => TitleVO::NAME,
                'label' => self::TITLE_LABEL,
            ],
            'attributes' => [
                'placeholder' => self::TITLE_PLACEHOLDER,
                'autocomplete' => 'off'
            ],
        ]);
    }
}
