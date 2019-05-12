<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Meta\Keywords;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use ZooShopDomain\Entity\Embeddable\Meta;
use Exception;

class MetaKeywordsType extends Type
{
    const COLUMN_NAME = 'keywords';

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
     * @return mixed|MetaKeywordsVO
     * @throws Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new MetaKeywordsVO($value);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param MetaKeywordsVO $value
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