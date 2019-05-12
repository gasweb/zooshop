<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Meta\Keywords;

use JsonSerializable;
use ZooShopDomain\Interfaces\IGet;

class MetaKeywordsVO implements IGet, JsonSerializable
{
    const NAME = 'meta_keywords';

    /** @var string $keywords */
    private $keywords = null;

    /**
     * MetaKeywordsVO constructor.
     * @param string|null $keywords
     */
    public function __construct(?string $keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->keywords;
    }

    /**
     * @return string|null
     */
    public function get() : ?string
    {
        return $this->keywords;
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
        return $this->get();
    }

    /**
     * @param MetaKeywordsVO $metaKeywords
     * @return bool
     */
    public function equals(MetaKeywordsVO $metaKeywords) : bool
    {
        return $metaKeywords->get() === $this->get();
    }
}
