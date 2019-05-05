<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product\Create;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class CreateFormInputFilter extends InputFilter
{
    const TITLE_ERRORS = [
        NotEmpty::IS_EMPTY => 'PRODUCT_TITLE_IS_EMPTY'
    ];
    const CATEGORY_ERRORS = [
        NotEmpty::IS_EMPTY => 'CATEGORY_IS_EMPTY'
    ];

    public function __construct()
    {
        $this->add(
            [
                'name' => CreateForm::TITLE['name'],
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class],
                ],
                'validators' => [
                    [
                        'name' => NotEmpty::class,
                        'options' => [
                            'messages' => [
                                NotEmpty::IS_EMPTY => self::TITLE_ERRORS[NotEmpty::IS_EMPTY]
                            ]
                        ]
                    ]
                ]
            ]
        );
        $this->add(
            [
                'name' => CreateForm::CATEGORY['name'],
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class],
                ],
                'error_message' => self::CATEGORY_ERRORS[NotEmpty::IS_EMPTY]
            ]
        );
    }
}