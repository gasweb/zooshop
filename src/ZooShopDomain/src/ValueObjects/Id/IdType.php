<?php
namespace ZooShopDomain\ValueObjects\Id;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class IdType extends Type
{

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new IdVO($value);
        } catch (\Exception $exception) {
        }
    }

    /**
     * @param IdVO $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->get();
    }

    public function getName()
    {
        return IdVO::NAME;
    }
}
