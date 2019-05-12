<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Category;

use JsonSerializable;

class CategoryVO implements JsonSerializable
{
    private $category;

    const AVAILABLE_CATEGORIES = [
        'DOG_COSMETICS' => [
            'label' => 'DOG_COSMETICS_CATEGORY',
            'options' => [
                'DOG_SHAMPOO' => 'DOG_SHAMPOO_CATEGORY',
                'DOG_CONDITIONER' => 'DOG_CONDITIONER_CATEGORY',
                'DOG_SPRAY' => 'DOG_SPRAY_CATEGORY',
                'DOG_SUPPLEMENTS' => 'DOG_SUPPLEMENTS_CATEGORY',
                'DOG_STYLING' => 'DOG_STYLING_CATEGORY',
                'DOG_REPLASCENT' => 'DOG_REPLASCENT_CATEGORY',
                'DOG_POWDER' => 'DOG_POWDER_CATEGORY',
            ]
        ],
        'DOG_CLOTHES' => [
            'label' => 'DOG_CLOTHES_CATEGORY',
            'options' => [
                'DOG_RAINCOATS' => 'DOG_RAINCOATS_CATEGORY',
                'DOG_JUMPSUITS' => 'DOG_JUMPSUITS_CATEGORY',
                'DOG_JUMPSUITS_FOR_CORGI' => 'DOG_JUMPSUITS_FOR_CORGI_CATEGORY',
                'DOG_JUMPSUITS_FOR_DACHSHUNDS' => 'DOG_JUMPSUITS_FOR_DACHSHUNDS_CATEGORY',
                'DOG_ANTHERS' => 'DOG_ANTHERS_CATEGORY',
                'DOG_WARM_OVERALLS' => 'DOG_WARM_OVERALLS_CATEGORY',
                'DOG_SHOES_FOR_DOGS' => 'DOG_SHOES_FOR_DOGS_CATEGORY',
                'DOG_JACKETS' => 'DOG_JACKETS_CATEGORY',
                'DOG_VESTS' => 'DOG_VESTS_CATEGORY',
                'DOG_MIKE' => 'DOG_MIKE_CATEGORY',
                'DOG_SUITS' => 'DOG_SUITS_CATEGORY'
            ]
        ]
    ];

    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->category;
    }

    /**
     * @param string $category
     * @return CategoryVO
     */
    public static function create(string $category) : CategoryVO
    {
        return new self($category);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->__toString();
    }
}
