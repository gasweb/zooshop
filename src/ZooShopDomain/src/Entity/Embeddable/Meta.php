<?php
declare(strict_types = 1);

namespace ZooShopDomain\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;
use ZooShopDomain\ValueObjects\Meta\Description\MetaDescriptionVO;
use ZooShopDomain\ValueObjects\Meta\Keywords\MetaKeywordsVO;
use ZooShopDomain\ValueObjects\Meta\MetaVO;
use ZooShopDomain\ValueObjects\Meta\Title\MetaTitleVO;

/**
 * Class Meta
 * @package ZooShopDomain\Entity\Embeddable
 * @ORM\Embeddable()
 */
class Meta
{
    const NAME = 'meta';
    const META_TITLE = 'meta_title';
    const META_DESCRIPTION = 'meta_description';
    const META_KEYWORDS = 'meta_keywords';

    public function __construct(MetaVO $meta)
    {
        $this->metaTitle = $meta->title();
        $this->metaDescription = $meta->description();
        $this->metaKeywords = $meta->keywords();
    }

    /**
     * @var MetaTitleVO $metaTitle
     * @ORM\Column(name="title", type="metaTitle", length=1000, nullable=true)
     */
    private $metaTitle;

    /**
     * @var MetaDescriptionVO $metaDescription
     * @ORM\Column(name="description", type="metaDescription", length=1000, nullable=true)
     */
    private $metaDescription;

    /**
     * @var MetaKeywordsVO $metaKeywords
     * @ORM\Column(name="keywords", type="metaKeywords", length=1000, nullable=true)
     */
    private $metaKeywords;
}