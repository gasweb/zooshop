<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Sku;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Exception;

class SkuType extends Type
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
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed|SkuVO
     * @throws Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new SkuVO($value);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param SkuVO $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->get();
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
        return SkuVO::NAME;
    }
}