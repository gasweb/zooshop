<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Category;

class CategoryVO
{
    private $category;

    const AVAILABLE_CATEGORIES = [
        'DOG_COSMETICS' => 'DOG_COSMETICS_CATEGORY'
    ];

    public function __construct($category)
    {
        $this->category = $category;
    }
}