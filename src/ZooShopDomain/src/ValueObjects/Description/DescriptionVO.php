<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Description;

use JsonSerializable;
use ZooShopDomain\Interfaces\IGet;

class DescriptionVO implements JsonSerializable, IGet
{
    const NAME = 'description';

    /** @var string $description */
    private $description;


    /**
     * DescriptionVO constructor.
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
     * @param DescriptionVO $description
     * @return bool
     */
    public function equals(DescriptionVO $description) : bool
    {
        return $this->description === $description;
    }


    /**
     * @param string|null $description
     * @return DescriptionVO
     */
    public static function create(?string $description) : DescriptionVO
    {
        return new self($description);
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

    public function get()
    {
        return $this->description;
    }
}
