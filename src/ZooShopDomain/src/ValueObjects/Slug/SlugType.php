<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Slug;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Exception;

class SlugType extends Type
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
     * @return mixed|SlugVO
     * @throws Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new SlugVO($value);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param SlugVO $value
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
        return SlugVO::NAME;
    }
}
