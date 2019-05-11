<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Brand;

use JsonSerializable;
use ZooShopDomain\Interfaces\IGet;
use Exception;

class BrandVO implements IGet, JsonSerializable
{
    const NAME = 'brand';

    const ISLE_OF_DOGS = 'Isle Of Dogs';

    const AVAILABLE_BRANDS = [
        'ISLE_OF_DOGS' => self::ISLE_OF_DOGS
    ];

    private $brand;

    public function __construct(?string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->brand;
    }

    /**
     * @param BrandVO $brand
     * @return bool
     */
    public function equals(BrandVO $brand) : bool
    {
        return $brand->get() === $this->brand;
    }

    /**
     * @return string|null
     */
    public function get()
    {
        return $this->brand;
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
        return $this->brand;
    }

    /**
     * @param string|null $brand
     * @return BrandVO
     * @throws Exception
     */
    public static function create(?string $brand) : BrandVO
    {
        try {
            return new self($brand);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
