<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Slug;

use JsonSerializable;

class SlugVO implements JsonSerializable
{
    const NAME = 'slug';

    /** @var string $slug */
    private $slug;


    /**
     * SlugVO constructor.
     * @param string|null $slug
     */
    public function __construct(?string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->slug;
    }

    /**
     * @param SlugVO $slug
     * @return bool
     */
    public function equals(SlugVO $slug) : bool
    {
        return $this->slug === $slug;
    }


    /**
     * @param string|null $slug
     * @return SlugVO
     */
    public static function create(?string $slug) : SlugVO
    {
        return new self($slug);
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
        return $this->__toString();
    }
}
