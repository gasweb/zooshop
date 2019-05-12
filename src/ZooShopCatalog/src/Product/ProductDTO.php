<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product;

use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Brand\BrandVO;
use ZooShopDomain\ValueObjects\Category\CategoryVO;
use ZooShopDomain\ValueObjects\Description\DescriptionVO;
use ZooShopDomain\ValueObjects\Id\IdVO;
use ZooShopDomain\ValueObjects\OriginalTitle\OriginalTitleVO;
use ZooShopDomain\ValueObjects\Sku\SkuVO;
use ZooShopDomain\ValueObjects\Slug\SlugVO;
use ZooShopDomain\ValueObjects\Title\TitleVO;
use Exception;

class ProductDTO
{
    /** @var IdVO $id */
    private $id;

    /** @var string|null $title */
    private $title = null;

    /** @var null|string $originalTitle */
    private $originalTitle = null;

    /** @var string|null $category */
    private $category = null;

    /** @var string|null $brand */
    private $brand = null;

    /** @var null|string $sku */
    private $sku = null;

    /** @var null|string $description */
    private $description = null;

    /** @var null|string $slug */
    private $slug = null;

    public function __construct(IdVO $id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function generateValueObjects() : array
    {
        try {
            return [
                Product::ID => $this->id,
                Product::TITLE => TitleVO::create($this->title),
                Product::CATEGORY => CategoryVO::create($this->category),
                Product::BRAND => BrandVO::create($this->brand),
                Product::ORIGINAL_TITLE => OriginalTitleVO::create($this->originalTitle),
                Product::SKU => SkuVO::create($this->sku),
                Product::DESCRIPTION => DescriptionVO::create($this->description),
                Product::SLUG => SlugVO::create($this->slug),
            ];
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ProductDTO
     */
    public function setTitle(string $title): ProductDTO
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return ProductDTO
     */
    public function setCategory(string $category): ProductDTO
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getId() : IdVO
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return ProductDTO
     */
    public function setBrand(string $brand): ProductDTO
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    /**
     * @param string|null $originalTitle
     * @return ProductDTO
     */
    public function setOriginalTitle(?string $originalTitle): ProductDTO
    {
        $this->originalTitle = $originalTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     * @return ProductDTO
     */
    public function setSku(?string $sku): ProductDTO
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return ProductDTO
     */
    public function setDescription(?string $description): ProductDTO
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return ProductDTO
     */
    public function setSlug(?string $slug): ProductDTO
    {
        $this->slug = $slug;
        return $this;
    }
}
