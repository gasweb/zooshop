<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\OriginalTitle;

use JsonSerializable;
use ZooShopDomain\Interfaces\IGet;
use Exception;

class OriginalTitleVO implements JsonSerializable, IGet
{
    const NAME = 'original_title';

    /** @var string $title */
    private $title;


    /**
     * OriginalTitleVO constructor.
     * @param string|null $title
     */
    public function __construct(?string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->title;
    }

    /**
     * @param OriginalTitleVO $title
     * @return bool
     */
    public function equals(OriginalTitleVO $title) : bool
    {
        return $this->title === $title;
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
        return $this->__toString();
    }

    /**
     * @return string|null
     */
    public function get() : ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $originalTitle
     * @return OriginalTitleVO
     * @throws Exception
     */
    public static function create(?string $originalTitle) : OriginalTitleVO
    {
        try {
            return new OriginalTitleVO($originalTitle);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
