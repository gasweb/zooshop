<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Sku;

use ZooShopDomain\Interfaces\IGet;
use JsonSerializable;
use Exception;

final class SkuVO implements IGet, JsonSerializable
{
    const NAME = 'sku';

    private $sku;

    public function __construct(string $sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->sku;
    }

    /**
     * @param SkuVO $sku
     * @return bool
     */
    public function equals(SkuVO $sku) : bool
    {
        return $sku->__toString() === $this->__toString();
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->__toString();
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
     * @param string $sku
     * @return SkuVO
     * @throws Exception
     */
    public static function create(string $sku) : SkuVO
    {
        try {
            return new SkuVO($sku);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}