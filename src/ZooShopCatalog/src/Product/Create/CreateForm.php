<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product\Create;

use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethodsHydrator;
use ZooShopApp\ConfigProvider;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Category\CategoryVO;

class CreateForm extends Form
{
    protected $attributes = [
        'method' => 'POST',
        'action' => ConfigProvider::PRODUCT_CREATE_PROCESSOR['route']
    ];

    const TITLE = [
        'name' => Product::TITLE,
        'label' => 'CREATE_PRODUCT_FORM_TITLE_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_TITLE_PLACEHOLDER',
    ];

    const SUBMIT = [
        'name' => 'submit',
        'attributes' => [
            'class' => 'btn btn-outline-success',
            'value' => 'SAVE_BUTTON',
        ]
    ];

    const CATEGORY = [
        'name' => Product::CATEGORY,
        'label' => 'CREATE_PRODUCT_FORM_CATEGORY_LABEL',
        'default' => 'CREATE_PRODUCT_FORM_CATEGORY_DEFAULT',
    ];

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->setHydrator(new ClassMethodsHydrator());
        $this->addTitle();
        $this->addCategories();
        $this->addSubmit();
        $this->setInputFilter(new CreateFormInputFilter());
    }

    private function addTitle() : void
    {
        $this->add([
            'name' => self::TITLE['name'],
            'type' => Text::class,
            'options' => [
                'property' => Product::TITLE,
                'label' => self::TITLE['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::TITLE['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => Product::TITLE
            ],
        ]);
    }

    private function addCategories() : void
    {
        $this->add(
            [
                'name' => self::CATEGORY['name'],
                'type' => Select::class,
                'options' => [
                    'property' => Product::CATEGORY,
                    'label' => self::CATEGORY['label'],
                    'label_attributes' => [
                        'class' => 'col-sm-4 col-form-label'
                    ],
                    'empty_option' => self::CATEGORY['default'],
                    'value_options' => CategoryVO::AVAILABLE_CATEGORIES
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );
    }

    private function addSubmit() : void
    {
        $this->add(
            [
                'name' => self::SUBMIT['name'],
                'type' => Submit::class,
                'attributes' => self::SUBMIT['attributes']
            ]
        );
    }

    public function getTitle()
    {
        return $this->get(Product::TITLE);
    }

    public function getCategory()
    {
        return $this->get(Product::CATEGORY);
    }

    public function getSubmit()
    {
        return $this->get(self::SUBMIT['name']);
    }

    public function getSubmitValue()
    {
        return self::SUBMIT['attributes']['value'];
    }
}
