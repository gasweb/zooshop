<?php
namespace ZooShopDomain\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZooShopCatalog\Product\ProductDTO;
use ZooShopDomain\Entity\Traits\EntityUuidTrait;
use ZooShopDomain\ValueObjects\Id\IdVO;
use ZooShopDomain\ValueObjects\Title\TitleVO;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product implements JsonSerializable
{
    use EntityUuidTrait;

    const TITLE = 'title';
    const CATEGORY = 'category';

    /**
     * @var TitleVO $title
     * @ORM\Column(name="title", type="title", length=100, nullable=false)
     */
    private $title;

    /**
     * @var TitleVO $originalTitle
     * @ORM\Column(name="original_title", type="title", length=100, nullable=true)
     */
    private $originalTitle;
    private $sku;
    private $brand;
    private $category;
    private $metaTitle;
    private $metaDescription;
    private $metaKeyWords;

    public function __construct(
        IdVO $id,
        TitleVO $title
    ) {
        $this->id = $id;
        $this->title = $title;
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
            IdVO::create(),
            $valueObjects[self::TITLE]
        );
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
            IdVO::NAME => $this->id,
            self::TITLE => $this->title,
            self::CATEGORY => $this->category
        ];
    }

    /**
     * @param Product $product
     * @return ProductDTO
     */
    public function createDTO() : ProductDTO
    {
        $productDTO = new ProductDTO();
        $productDTO->setTitle($this->title->__toString());
        return $productDTO;
    }
}
