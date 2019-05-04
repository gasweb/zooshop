<?php
namespace ZooShopDomain\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZooShopDomain\Entity\Traits\EntityUuidTrait;
use ZooShopDomain\ValueObjects\Id\IdVO;
use ZooShopDomain\ValueObjects\Title\TitleVO;

class Product
{
    const TITLE = 'title';

    /** @var TitleVO $title
     *  @ORM\Column(name="title", type="title", length=100, nullable=false)
     */
    private $title;

    /**
     * @var TitleVO $originalTitle
     * @ORM\Column(name="original_title", type="title")
     */
    private $originalTitle;
    private $sku;
    private $brand;
    private $category;
    private $metaTitle;
    private $metaDescription;
    private $metaKeyWords;


    use EntityUuidTrait;

    public function __construct(
        IdVO $id,
        TitleVO $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }
}