<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Meta;

use Exception;
use JsonSerializable;
use ZooShopDomain\ValueObjects\Meta\Description\MetaDescriptionVO;
use ZooShopDomain\ValueObjects\Meta\Keywords\MetaKeywordsVO;
use ZooShopDomain\ValueObjects\Meta\Title\MetaTitleVO;

class MetaVO implements JsonSerializable
{

    /** @var MetaTitleVO $title */
    private $title;

    /** @var MetaKeywordsVO $keywords */
    private $keywords;

    /** @var MetaDescriptionVO $description */
    private $description;

    public function __construct(
        MetaTitleVO $metaTitle,
        MetaDescriptionVO $metaDescription,
        MetaKeywordsVO $metaKeywords
    ) {
        $this->title = $metaTitle;
        $this->description = $metaDescription;
        $this->keywords = $metaKeywords;
    }

    /**
     * @return MetaTitleVO
     */
    public function title(): MetaTitleVO
    {
        return $this->title;
    }

    /**
     * @return MetaKeywordsVO
     */
    public function keywords(): MetaKeywordsVO
    {
        return $this->keywords;
    }

    /**
     * @return MetaDescriptionVO
     */
    public function description(): MetaDescriptionVO
    {
        return $this->description;
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
            MetaTitleVO::NAME => $this->title()->jsonSerialize(),
            MetaDescriptionVO::NAME => $this->description()->jsonSerialize(),
            MetaKeywordsVO::NAME => $this->keywords()->jsonSerialize(),
        ];
    }

    /**
     * @param MetaTitleVO $metaTitle
     * @param MetaDescriptionVO $metaDescription
     * @param MetaKeywordsVO $metaKeywords
     * @return MetaVO
     * @throws Exception
     */
    public static function create(
        MetaTitleVO $metaTitle,
        MetaDescriptionVO $metaDescription,
        MetaKeywordsVO $metaKeywords
    ) {
        try {
            return new self(
                $metaTitle,
                $metaDescription,
                $metaKeywords
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}