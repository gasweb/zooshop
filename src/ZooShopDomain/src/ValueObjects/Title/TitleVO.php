<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Title;

use JsonSerializable;

class TitleVO implements JsonSerializable
{
    const NAME = 'title';

    /** @var string $title */
    private $title;

    /**
     * TitleVO constructor.
     * @param string $title
     */
    public function __construct(string $title)
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
     * @param TitleVO $title
     * @return bool
     */
    public function equals(TitleVO $title) : bool
    {
        return $this->title === $title;
    }

    /**
     * @param string $title
     * @return TitleVO
     */
    public static function create(string $title) : TitleVO
    {
        return new self($title);
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