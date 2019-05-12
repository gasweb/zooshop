<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Meta\Title;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Exception;

class MetaTitleType extends Type
{

    const COLUMN_NAME = 'title';

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
     * @return mixed|MetaTitleVO
     * @throws Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new MetaTitleVO($value);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param MetaTitleVO $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->__toString();
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
        return self::COLUMN_NAME;
    }
}