<?php
namespace ZooShopDomain\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZooShopCatalog\Product\ProductDTO;
use ZooShopDomain\Entity\Traits\EntityUuidTrait;
use ZooShopDomain\ValueObjects\Category\CategoryVO;
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
    const ID = 'id';

    /**
     * @var TitleVO $title
     * @ORM\Column(name="title", type="title", length=100, nullable=false)
     */
    private $title;

    /**
     * @var CategoryVO $category
     * @ORM\Column(name="category", type="category", length=100, nullable=false)
     */
    private $category;


    private $originalTitle;
    private $sku;
    private $brand;
    private $metaTitle;
    private $metaDescription;
    private $metaKeyWords;

    public function __construct(
        IdVO $id,
        TitleVO $title,
        CategoryVO $category
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
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
            $valueObjects[self::CATEGORY]
        );
    }

    public function updateFromDTO(ProductDTO $productDTO)
    {
        $valueObjects = $productDTO->generateValueObjects();
        $this->title = $valueObjects[self::TITLE];
        $this->title = $valueObjects[self::CATEGORY];
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
            self::CATEGORY => $this->category
        ];
    }

    /**
     * @param Product $product
     * @return ProductDTO
     */
    public function createDTO() : ProductDTO
    {
        $productDTO = new ProductDTO(
            IdVO::create($this->id)
        );
        $productDTO->setTitle($this->title->__toString());
        return $productDTO;
    }
}
