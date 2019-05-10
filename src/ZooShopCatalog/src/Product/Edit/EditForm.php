<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product\Edit;

use ZooShopCatalog\Product\AbstractManagementForm;

class EditForm extends AbstractManagementForm
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
    }
}
