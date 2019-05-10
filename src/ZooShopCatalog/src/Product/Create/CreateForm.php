<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product\Create;

use ZooShopApp\ConfigProvider;
use ZooShopCatalog\Product\AbstractManagementForm;

class CreateForm extends AbstractManagementForm
{
    protected $attributes = [
        'method' => 'POST',
        'action' => ConfigProvider::PRODUCT_CREATE_PROCESSOR['route']
    ];

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
    }
}
