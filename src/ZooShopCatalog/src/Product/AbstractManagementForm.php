<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;
use ZooShopCatalog\Product\Create\CreateFormInputFilter;
use ZooShopDomain\Entity\Embeddable\Meta;
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
        'id' => Product::TITLE,
        'label' => 'CREATE_PRODUCT_FORM_TITLE_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_TITLE_PLACEHOLDER',
    ];

    const ORIGINAL_TITLE = [
        'name' => Product::ORIGINAL_TITLE,
        'id' => Product::ORIGINAL_TITLE,
        'label' => 'CREATE_PRODUCT_FORM_ORIGINAL_TITLE_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_ORIGINAL_TITLE_PLACEHOLDER',
    ];

    const CATEGORY = [
        'name' => Product::CATEGORY,
        'id' => Product::CATEGORY,
        'label' => 'CREATE_PRODUCT_FORM_CATEGORY_LABEL',
        'default' => 'CREATE_PRODUCT_FORM_CATEGORY_DEFAULT',
    ];

    const BRAND = [
        'name' => Product::BRAND,
        'id' => Product::BRAND,
        'label' => 'CREATE_PRODUCT_FORM_BRAND_LABEL',
        'default' => 'CREATE_PRODUCT_FORM_BRAND_DEFAULT',
    ];

    const SKU = [
        'name' => Product::SKU,
        'id' => Product::SKU,
        'label' => 'CREATE_PRODUCT_FORM_SKU_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_SKU_PLACEHOLDER',
    ];

    const DESCRIPTION = [
        'name' => Product::DESCRIPTION,
        'id' => Product::DESCRIPTION,
        'label' => 'CREATE_PRODUCT_FORM_DESCRIPTION_LABEL',
        'placeholder' => 'CREATE_PRODUCT_FORM_DESCRIPTION_PLACEHOLDER',
    ];

    const SLUG = [
        'name' => Product::SLUG,
        'id' => Product::SLUG,
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

    const META = [
        Meta::META_TITLE => [
            'name' => Meta::META_TITLE,
            'id' => Meta::META_TITLE,
            'label' => 'CREATE_PRODUCT_FORM_META_TITLE_LABEL',
            'placeholder' => 'CREATE_PRODUCT_FORM_META_TITLE_PLACEHOLDER',
        ],
        Meta::META_DESCRIPTION => [
            'name' => Meta::META_DESCRIPTION,
            'id' => Meta::META_DESCRIPTION,
            'label' => 'CREATE_PRODUCT_FORM_META_DESCRIPTION_LABEL',
            'placeholder' => 'CREATE_PRODUCT_FORM_META_DESCRIPTION_PLACEHOLDER',
        ],
        Meta::META_KEYWORDS => [
            'name' => Meta::META_KEYWORDS,
            'id' => Meta::META_KEYWORDS,
            'label' => 'CREATE_PRODUCT_FORM_META_KEYWORDS_LABEL',
            'placeholder' => 'CREATE_PRODUCT_FORM_META_KEYWORDS_PLACEHOLDER',
        ]
    ];

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->setHydrator(new ClassMethods());
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
        $this->addMetaTitle();
        $this->addMetaDescription();
        $this->addMetaKeywords();
        $this->addCsrf();
        $this->addSubmit();
    }

    protected function addMetaTitle() : void
    {
        $this->add([
            'name' => self::META[Meta::META_TITLE]['name'],
            'type' => Text::class,
            'options' => [
                'label' => self::META[Meta::META_TITLE]['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::META[Meta::META_TITLE]['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => self::META[Meta::META_TITLE]['id']
            ],
        ]);
    }

    protected function addMetaDescription() : void
    {
        $this->add([
            'name' => self::META[Meta::META_DESCRIPTION]['name'],
            'type' => Textarea::class,
            'options' => [
                'label' => self::META[Meta::META_DESCRIPTION]['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::META[Meta::META_DESCRIPTION]['placeholder'],
                'class' => 'form-control',
                'id' => self::META[Meta::META_DESCRIPTION]['id']
            ],
        ]);
    }

    protected function addMetaKeywords() : void
    {
        $this->add([
            'name' => self::META[Meta::META_KEYWORDS]['name'],
            'type' => Text::class,
            'options' => [
                'label' => self::META[Meta::META_KEYWORDS]['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::META[Meta::META_KEYWORDS]['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => self::META[Meta::META_KEYWORDS]['id']
            ],
        ]);
    }

    protected function addTitle() : void
    {
        $this->add([
            'name' => self::TITLE['name'],
            'type' => Text::class,
            'options' => [
                'label' => self::TITLE['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::TITLE['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => self::TITLE['id']
            ],
        ]);
    }

    protected function addOriginalTitle() : void
    {
        $this->add([
            'name' => self::ORIGINAL_TITLE['name'],
            'type' => Text::class,
            'options' => [
                'label' => self::ORIGINAL_TITLE['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::ORIGINAL_TITLE['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => self::ORIGINAL_TITLE['id']
            ],
        ]);
    }

    protected function addSku() : void
    {
        $this->add([
            'name' => self::SKU['name'],
            'type' => Text::class,
            'options' => [
                'label' => self::SKU['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::SKU['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => self::SKU['id']
            ],
        ]);
    }

    protected function addDescription() : void
    {
        $this->add([
            'name' => self::DESCRIPTION['name'],
            'type' => Text::class,
            'options' => [
                'label' => self::DESCRIPTION['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::DESCRIPTION['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => self::DESCRIPTION['id']
            ],
        ]);
    }

    protected function addSlug() : void
    {
        $this->add([
            'name' => self::SLUG['name'],
            'type' => Text::class,
            'options' => [
                'label' => self::SLUG['label'],
                'label_attributes' => [
                    'class' => 'col-sm-4 col-form-label'
                ],
            ],
            'attributes' => [
                'placeholder' => self::SLUG['placeholder'],
                'autocomplete' => 'off',
                'class' => 'form-control',
                'id' => self::SLUG['id']
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

    public function getMetaTitle()
    {
        return $this->get(self::META[Meta::META_TITLE]['name']);
    }

    public function getMetaDescription()
    {
        return $this->get(self::META[Meta::META_DESCRIPTION]['name']);
    }

    public function getMetaKeywords()
    {
        return $this->get(self::META[Meta::META_KEYWORDS]['name']);
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
