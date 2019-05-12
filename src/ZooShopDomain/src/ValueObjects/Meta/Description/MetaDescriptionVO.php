<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Meta\Description;

use JsonSerializable;
use ZooShopDomain\Interfaces\IGet;

class MetaDescriptionVO implements IGet, JsonSerializable
{
    /** @var string $description */
    private $description = null;

    /**
     * MetaDescriptionVO constructor.
     * @param string|null $description
     */
    public function __construct(?string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->description;
    }

    /**
     * @return string|null
     */
    public function get() : ?string
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
        return $this->get();
    }

    /**
     * @param MetaDescriptionVO $metaDescription
     * @return bool
     */
    public function equals(MetaDescriptionVO $metaDescription) : bool
    {
        return $metaDescription->get() === $this->get();
    }
}
