<?php
declare(strict_types = 1);

namespace ZooShopDomain\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;
use ZooShopDomain\ValueObjects\Meta\Description\MetaDescriptionVO;
use ZooShopDomain\ValueObjects\Meta\Keywords\MetaKeywordsVO;
use ZooShopDomain\ValueObjects\Meta\Title\MetaTitleVO;

/**
 * Class Meta
 * @package ZooShopDomain\Entity\Embeddable
 * @ORM\Embeddable()
 */
class Meta
{
    const META_TITLE = 'title';
    const META_DESCRIPTION = 'description';
    const META_KEYWORDS = 'keywords';

    /**
     * @var MetaTitleVO $metaTitle
     * @ORM\Column(name="meta_title", type="metaTitle", length=1000, nullable=true)
     */
    private $metaTitle;

    /**
     * @var MetaDescriptionVO $metaDescription
     * @ORM\Column(name="meta_description", type="metaDescription", length=1000, nullable=true)
     */
    private $metaDescription;

    /**
     * @var MetaKeywordsVO $metaKeywords
     * @ORM\Column(name="meta_keywords", type="metaKeywords", length=1000, nullable=true)
     */
    private $metaKeywords;
}