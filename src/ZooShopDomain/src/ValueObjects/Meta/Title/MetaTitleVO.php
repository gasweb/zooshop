<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Meta\Title;

use JsonSerializable;
use ZooShopDomain\Interfaces\IGet;

class MetaTitleVO implements IGet, JsonSerializable
{
    /** @var string $title */
    private $title = null;

    /**
     * MetaTitleVO constructor.
     * @param string|null $title
     */
    public function __construct(?string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->title;
    }

    /**
     * @return string|null
     */
    public function get() : ?string
    {
        return $this->title;
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
     * @param MetaTitleVO $metaTitle
     * @return bool
     */
    public function equals(MetaTitleVO $metaTitle) : bool
    {
        return $metaTitle->get() === $this->get();
    }
}
