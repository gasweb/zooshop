<?php
namespace ZooShopDomain\ValueObjects\Id;

use Ramsey\Uuid\Uuid;
use Exception;
use JsonSerializable;
use ZooShopDomain\Interfaces\IGet;

class IdVO implements JsonSerializable, IGet
{
    const NAME = 'id';

    /** @var string $id */
    private $id;

    public function __construct(string $id = null)
    {
        if (!$id) {
            try {
                $id = Uuid::uuid4()->toString();
            } catch (Exception $exception) {
            }
        }
        $this->id = $id;
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    public function jsonSerialize()
    {
        return $this->__toString();
    }

    /**
     * @param null $id
     * @return IdVO
     */
    public static function create($id = null) : IdVO
    {
        return new self($id);
    }

    /**
     * @return IdVO
     */
    public static function createNew() : IdVO
    {
        try {
            return self::create(Uuid::uuid4()->toString());
        } catch (Exception $exception) {
        }
    }

    public function get()
    {
        return $this->__toString();
    }
}
