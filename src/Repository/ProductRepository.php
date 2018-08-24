<?php

namespace App\Repository;

use App\Entity\Interfaces\ProductInterface;
use App\Entity\Product;
use App\Entity\ProductDetail;
use App\Repository\Interfaces\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * final Class ProductRepository.
 */
final class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByUuidField($value): ?ProductInterface
    {
        return $this->createQueryBuilder('p')
            ->innerJoin(ProductDetail::class, 'pd')
            ->andWhere('p.uid = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findAllProducts(): array
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findOtherProduct(ProductInterface $product): ?ProductInterface
    {
        $productDetail = $product->getProductDetail();
        return $this->createQueryBuilder('p')
            ->innerJoin('p.productDetail', 'pd')
            ->where('p.name = :name')
            ->andWhere('p.price = :price')
            ->andWhere('pd.brand = :brand')
            ->andWhere('pd.color = :color')
            ->andWhere('pd.height = :height')
            ->andWhere('pd.memory = :memory')
            ->andWhere('pd.os = :os')
            ->andWhere('pd.screenSize = :screenSize')
            ->andWhere('pd.thickness = :thickness')
            ->andWhere('pd.weight = :weight')
            ->andWhere('pd.width = :width')
            ->setParameters(array(
                'name'       => $product->getName(),
                'price'      => $product->getPrice(),
                'brand'      => $productDetail->getBrand(),
                'color'      => $productDetail->getColor(),
                'height'     => $productDetail->getHeight(),
                'memory'     => $productDetail->getMemory(),
                'os'         => $productDetail->getOs(),
                'screenSize' => $productDetail->getScreenSize(),
                'thickness'  => $productDetail->getThickness(),
                'weight'     => $productDetail->getWeight(),
                'width'      => $productDetail->getWidth()
            ))
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
