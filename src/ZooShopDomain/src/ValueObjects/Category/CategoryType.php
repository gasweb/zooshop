<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Category;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use ZooShopDomain\Entity\Product;

class CategoryType extends Type
{

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param mixed[] $fieldDeclaration The field declaration.
     * @param AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     * @return mixed|CategoryVO
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new CategoryVO($value);
        } catch (\Exception $exception) {
        }
    }

    /**
     * @param CategoryVO $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->__tostring();
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return Product::CATEGORY;
    }
}
