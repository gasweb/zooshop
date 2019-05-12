<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product;

use phpDocumentor\Reflection\DocBlock\Tags\See;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethodsHydrator;
use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\Create\CreateFormInputFilter;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Brand\BrandVO;
use ZooShopDomain\ValueObjects\Category\CategoryVO;

class AbstractManagementForm extends Form
{
    protected $attributes = [
        'method' => 'POST',
    ];

    const TITLE = [
        'name' => Product::TITLE,
        'label' => 'CREATE_PRODUCT_FORM_TITLE_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_TITLE_PLACEHOLDER',
    ];

    const ORIGINAL_TITLE = [
        'name' => Product::ORIGINAL_TITLE,
        'label' => 'CREATE_PRODUCT_FORM_ORIGINAL_TITLE_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_ORIGINAL_TITLE_PLACEHOLDER',
    ];

    const CATEGORY = [
        'name' => Product::CATEGORY,
        'label' => 'CREATE_PRODUCT_FORM_CATEGORY_LABEL',
        'default' => 'CREATE_PRODUCT_FORM_CATEGORY_DEFAULT',
    ];

    const BRAND = [
        'name' => Product::BRAND,
        'label' => 'CREATE_PRODUCT_FORM_BRAND_LABEL',
        'default' => 'CREATE_PRODUCT_FORM_BRAND_DEFAULT',
    ];

    const SKU = [
        'name' => Product::SKU,
        'label' => 'CREATE_PRODUCT_FORM_SKU_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_SKU_PLACEHOLDER',
    ];

    const DESCRIPTION = [
        'name' => Product::DESCRIPTION,
        'label' => 'CREATE_PRODUCT_FORM_DESCRIPTION_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_DESCRIPTION_PLACEHOLDER',
    ];

    const SLUG = [
        'name' => Product::SLUG,
        'label' => 'CREATE_PRODUCT_FORM_SLUG_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_SLUG_PLACEHOLDER',
    ];

    const CSRF = [
        'name' => 'csrf'
    ];

    const SUBMIT = [
        'name' => 'submit',
        'attributes' => [
            'class' => 'btn btn-outline-success',
            'value' => 'SAVE_BUTTON',
        ]
    ];

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->setHydrator(new ClassMethodsHydrator());
        $this->addFormItems();
        $this->setInputFilter(new CreateFormInputFilter());
    }

    protected function addFormItems()
    {
        $this->addTitle();
        $this->addOriginalTitle();
        $this->addSku();
        $this->addCategories();
        $this->addBrands();
        $this->addSlug();
        $this->addDescription();
        $this->addCsrf();
        $this->addSubmit();
    }

    protected function addTitle() : void
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

    protected function addOriginalTitle() : void
    {
        $this->add([
            'name' => self::ORIGINAL_TITLE['name'],
            'type' => Text::class,
            'options' => [
                'property' => Product::ORIGINAL_TITLE,
                'label' => self::ORIGINAL_TITLE['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::ORIGINAL_TITLE['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => Product::ORIGINAL_TITLE
            ],
        ]);
    }

    protected function addSku() : void
    {
        $this->add([
            'name' => self::SKU['name'],
            'type' => Text::class,
            'options' => [
                'property' => Product::SKU,
                'label' => self::SKU['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::SKU['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => Product::SKU
            ],
        ]);
    }

    protected function addDescription() : void
    {
        $this->add([
            'name' => self::DESCRIPTION['name'],
            'type' => Text::class,
            'options' => [
                'property' => Product::SLUG,
                'label' => self::DESCRIPTION['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::DESCRIPTION['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => Product::DESCRIPTION
            ],
        ]);
    }

    protected function addSlug() : void
    {
        $this->add([
            'name' => self::SLUG['name'],
            'type' => Text::class,
            'options' => [
                'property' => Product::SLUG,
                'label' => self::SLUG['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::SLUG['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => Product::SLUG
            ],
        ]);
    }

    protected function addCategories() : void
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

    protected function addBrands() : void
    {
        $this->add(
            [
                'name' => self::BRAND['name'],
                'type' => Select::class,
                'options' => [
                    'property' => Product::BRAND,
                    'label' => self::BRAND['label'],
                    'label_attributes' => [
                        'class' => 'col-sm-4 col-form-label'
                    ],
                    'empty_option' => self::BRAND['default'],
                    'value_options' => BrandVO::AVAILABLE_BRANDS
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );
    }

    protected function addCsrf()
    {
        $this->add(
            [
                'name' => self::CSRF['name'],
                'type' => Csrf::class
            ]
        );
    }

    protected function addSubmit() : void
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
        return $this->get(self::TITLE['name']);
    }

    public function getOriginalTitle()
    {
        return $this->get(self::ORIGINAL_TITLE['name']);
    }

    public function getSku()
    {
        return $this->get(self::SKU['name']);
    }

    public function getCategory()
    {
        return $this->get(self::CATEGORY['name']);
    }

    public function getBrands()
    {
        return $this->get(self::BRAND['name']);
    }

    public function getDescription()
    {
        return $this->get(self::DESCRIPTION['name']);
    }

    public function getSlug()
    {
        return $this->get(self::SLUG['name']);
    }

    public function getSubmit()
    {
        return $this->get(self::SUBMIT['name']);
    }

    public function getCsrf()
    {
        return $this->get(self::CSRF['name']);
    }

    public function getSubmitValue()
    {
        return self::SUBMIT['attributes']['value'];
    }
}
