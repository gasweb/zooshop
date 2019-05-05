<?php

use Zend\I18n\Translator\Loader\PhpArray;

return [
    'translator' => [
        'locale' => 'ru_RU',
        'translation_file_patterns' => [
            [
                'type'     => PhpArray::class,
                'base_dir' => __DIR__ . '/../../data/translates',
                'pattern' => '%s.php',
            ],

        ]
    ],
];