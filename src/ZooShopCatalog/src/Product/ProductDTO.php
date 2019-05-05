<?php
declare(strict_types = 1);

namespace ZooShopCatalog\Product;

use ZooShopDomain\Entity\Product;
use ZooShopDomain\ValueObjects\Category\CategoryVO;
use ZooShopDomain\ValueObjects\Title\TitleVO;
use Exception;

class ProductDTO
{
    /** @var string $title */
    private $title = null;

    /** @var string $category */
    private $category = null;

    /**
     * @return array
     * @throws Exception
     */
    public function generateValueObjects() : array
    {
        try {
            return [
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
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }
}
