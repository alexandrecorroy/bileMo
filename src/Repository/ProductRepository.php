<?php

namespace App\Repository;

use App\Entity\Interfaces\ProductInterface;
use App\Entity\Product;
use App\Repository\Interfaces\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param $value
     * @return ProductInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUuidField($value): ?ProductInterface
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.uid = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @return mixed
     */
    public function findAllProducts()
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
            ;
    }
}
