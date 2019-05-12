<?php
declare(strict_types = 1);

namespace ZooShopDomain\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;
use ZooShopDomain\ValueObjects\Meta\Description\MetaDescriptionVO;
use ZooShopDomain\ValueObjects\Meta\Keywords\MetaKeywordsVO;
use ZooShopDomain\ValueObjects\Meta\MetaVO;
use ZooShopDomain\ValueObjects\Meta\Title\MetaTitleVO;
use JsonSerializable;

/**
 * Class Meta
 * @package ZooShopDomain\Entity\Embeddable
 * @ORM\Embeddable()
 */
class Meta implements JsonSerializable
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

    /**
     * @return MetaTitleVO
     */
    public function metaTitle() : MetaTitleVO
    {
        return $this->metaTitle;
    }

    /**
     * @return MetaDescriptionVO
     */
    public function metaDescription() : MetaDescriptionVO
    {
        return $this->metaDescription;
    }

    /**
     * @return MetaKeywordsVO
     */
    public function metaKeywords() : MetaKeywordsVO
    {
        return $this->metaKeywords;
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
            self::META_TITLE => $this->metaTitle,
            self::META_DESCRIPTION => $this->metaDescription,
            self::META_KEYWORDS => $this->metaKeywords
        ];
    }
}