<?php
namespace ZooShopDomain\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use ZooShopDomain\ValueObjects\Id\IdVO;

trait EntityUuidTrait
{
    /**
     * The internal primary identity key.
     *
     * @var IdVO
     *
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Doctrine\ORM\Id\UuidGenerator")
     */
    protected $id;

    /**
     * @return IdVO
     */
    public function getId(): IdVO
    {
        return $this->id;
    }
}
