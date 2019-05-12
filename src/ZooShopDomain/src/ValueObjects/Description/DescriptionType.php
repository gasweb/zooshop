<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Description;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Exception;

class DescriptionType extends Type
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
        return Type::TEXT;
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     * @return mixed|DescriptionVO
     * @throws Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new DescriptionVO($value);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param DescriptionVO $value
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
        return DescriptionVO::NAME;
    }
}
