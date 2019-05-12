<?php
namespace ZooShopDomain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ZooShopCatalog\Product\ProductDTO;
use ZooShopDomain\Entity\Embeddable\Meta;
use ZooShopDomain\Entity\Traits\EntityUuidTrait;
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
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="product")
 */
class Product implements JsonSerializable
{
    use EntityUuidTrait;

    const ID = 'id';
    const TITLE = 'title';
    const ORIGINAL_TITLE = 'original_title';
    const SKU = 'sku';
    const CATEGORY = 'category';
    const BRAND = 'brand';
    const DESCRIPTION = 'description';
    const SLUG = 'slug';

    /**
     * @var TitleVO $title
     * @ORM\Column(name="title", type="title", length=100, nullable=false)
     */
    private $title;

    /**
     * @var OriginalTitleVO $originalTitle
     * @ORM\Column(name="original_title", type="originalTitle", length=100, nullable=true)
     */
    private $originalTitle;

    /**
     * @var SkuVO $sku
     * @ORM\Column(name="sku", type="sku", length=100, nullable=false)
     */
    private $sku;

    /**
     * @var CategoryVO $category
     * @ORM\Column(name="category", type="category", length=100, nullable=false)
     */
    private $category;

    /**
     * @var BrandVO $brand
     * @ORM\Column(name="brand", type="brand", length=100, nullable=true)
     */
    private $brand;

    /**
     * @var DescriptionVO $description
     * @ORM\Column(name="description", type="description", nullable=true)
     */
    private $description;

    /**
     * @var SlugVO $slug
     * @ORM\Column(name="slug", type="slug", length=100, nullable=true)
     */
    private $slug;

    /**
     * @var Meta $meta
     * @ORM\Embedded(class="ZooShopDomain\Entity\Embeddable\Meta")
     */
    private $meta;

    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        if (!$this->createdAt) {
            $this->createdAt = new DateTime('now');
        }

        $this->updatedAt = new DateTime('now');
    }

    public function __construct(
        IdVO $id,
        TitleVO $title,
        OriginalTitleVO $originalTitle,
        CategoryVO $category,
        BrandVO $brand,
        SkuVO $sku,
        DescriptionVO $description,
        SlugVO $slug,
        Meta $meta
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->originalTitle = $originalTitle;
        $this->category = $category;
        $this->brand = $brand;
        $this->sku = $sku;
        $this->description = $description;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    /**
     * @param ProductDTO $productDTO
     * @return Product
     * @throws \Exception
     */
    public static function createFromDTO(ProductDTO $productDTO) : Product
    {
        $valueObjects = $productDTO->generateValueObjects();
        return new self(
            $valueObjects[self::ID],
            $valueObjects[self::TITLE],
            $valueObjects[self::ORIGINAL_TITLE],
            $valueObjects[self::CATEGORY],
            $valueObjects[self::BRAND],
            $valueObjects[self::SKU],
            $valueObjects[self::DESCRIPTION],
            $valueObjects[self::SLUG],
            $valueObjects[Meta::NAME]
        );
    }

    public function updateFromDTO(ProductDTO $productDTO)
    {
        $valueObjects = $productDTO->generateValueObjects();
        $this->title = $valueObjects[self::TITLE];
        $this->originalTitle = $valueObjects[self::ORIGINAL_TITLE];
        $this->category = $valueObjects[self::CATEGORY];
        $this->brand = $valueObjects[self::BRAND];
        $this->sku = $valueObjects[self::SKU];
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
        return [
            self::ID => $this->id,
            self::TITLE => $this->title,
            self::ORIGINAL_TITLE => $this->originalTitle,
            self::CATEGORY => $this->category,
            self::BRAND => $this->brand,
            self::SKU => $this->sku,
            self::DESCRIPTION => $this->description,
            self::SLUG => $this->slug
        ];
    }

    /**
     * @return ProductDTO
     */
    public function createDTO() : ProductDTO
    {
        $productDTO = new ProductDTO(
            $this->id
        );
        $productDTO->setTitle($this->title->__toString())
            ->setCategory($this->category->__toString())
            ->setOriginalTitle($this->originalTitle->__toString())
            ->setBrand($this->brand->get())
            ->setSku($this->sku->get())
            ->setDescription($this->description->get())
            ->setSlug($this->slug->get());
        return $productDTO;
    }
}
