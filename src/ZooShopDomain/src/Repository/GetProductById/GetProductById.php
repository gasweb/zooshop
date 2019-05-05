<?php
declare(strict_types = 1);

namespace ZooShopDomain\Repository\GetProductById;

use Doctrine\ORM\EntityManagerInterface;
use ZooShopDomain\Entity\Product;
use ZooShopDomain\Exceptions\Product\ProductNotFoundException;
use ZooShopDomain\ValueObjects\Id\IdVO;

final class GetProductById
{
    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param IdVO $id
     * @return mixed
     * @throws ProductNotFoundException
     */
    public function __invoke(IdVO $id)
    {

        $queryBuilder = $this->entityManager->createQueryBuilder();
        $result = $queryBuilder->select('product')
            ->from(Product::class, 'product')
            ->where($queryBuilder->expr()->eq('product.'.IdVO::NAME, ':id'))
            ->setParameter(':id', $id->__toString())
            ->getQuery()
            ->getResult();

        if (!$result) {
            throw new ProductNotFoundException();
        }
        return array_shift($result);
    }
}
