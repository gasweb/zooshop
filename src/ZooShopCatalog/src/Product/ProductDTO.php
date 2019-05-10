<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product;

use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Category\CategoryVO;
use ZooShopDomain\ValueObjects\Id\IdVO;
use ZooShopDomain\ValueObjects\Title\TitleVO;
use Exception;

class ProductDTO
{
    /** @var string $title */
    private $title = null;

    /** @var string $category */
    private $category = null;

    /** @var IdVO $id */
    private $id;

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
                Product::CATEGORY => CategoryVO::create($this->category)
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
}
