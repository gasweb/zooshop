<?php
namespace ZooShopDomain\ValueObjects\Brand;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use ZooShopDomain\ValueObjects\Quantity\QuantityVO;

/**
 * Quantity data type
 */
class BrandType extends Type
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(100)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new BrandVO($value);
        } catch (\Exception $exception) {
        }
    }

    /**
     * @param QuantityVO $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->get();
    }

    public function getName()
    {
        return BrandVO::NAME;
    }
}
