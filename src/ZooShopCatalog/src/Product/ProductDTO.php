<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product;

use ZooShopDomain\Entity\Embeddable\Meta;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Brand\BrandVO;
use ZooShopDomain\ValueObjects\Category\CategoryVO;
use ZooShopDomain\ValueObjects\Description\DescriptionVO;
use ZooShopDomain\ValueObjects\Id\IdVO;
use ZooShopDomain\ValueObjects\Meta\Description\MetaDescriptionVO;
use ZooShopDomain\ValueObjects\Meta\Keywords\MetaKeywordsVO;
use ZooShopDomain\ValueObjects\Meta\MetaVO;
use ZooShopDomain\ValueObjects\Meta\Title\MetaTitleVO;
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

    /** @var string|null $metaTitle */
    private $metaTitle = null;

    /** @var string|null $metaDescription */
    private $metaDescription = null;

    /** @var string|null $metaKeywords */
    private $metaKeywords = null;

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
                Meta::NAME => new Meta(
                    MetaVO::create(
                        MetaTitleVO::create($this->metaTitle),
                        MetaDescriptionVO::create($this->metaDescription),
                        MetaKeywordsVO::create($this->metaKeywords)
                    )
                )
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

    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param string|null $metaTitle
     * @return ProductDTO
     */
    public function setMetaTitle(?string $metaTitle): ProductDTO
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param string|null $metaDescription
     * @return ProductDTO
     */
    public function setMetaDescription(?string $metaDescription): ProductDTO
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    /**
     * @param string|null $metaKeywords
     * @return ProductDTO
     */
    public function setMetaKeywords(?string $metaKeywords): ProductDTO
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }
}
