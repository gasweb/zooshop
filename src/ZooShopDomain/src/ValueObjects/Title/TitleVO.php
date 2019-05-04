<?php
declare(strict_types = 1);

namespace ZooShopDomain\ValueObjects\Title;

class TitleVO
{
    const NAME = 'title';

    /** @var string $title */
    private $title;

    /**
     * TitleVO constructor.
     * @param string $title
     */
    public function __construct(string $title)
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
     * @param TitleVO $title
     * @return bool
     */
    public function equals(TitleVO $title) : bool
    {
        return $this->title === $title;
    }
}