<?php

namespace App\Repository;

use App\Entity\Interfaces\ProductInterface;
use App\Entity\Product;
use App\Entity\ProductDetail;
use App\Repository\Interfaces\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Cache\ApcuCache;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * final Class ProductRepository.
 */
final class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    /**
     * @var ApcuCache
     */
    private $cache;

    /**
     * {@inheritdoc}
     */
    public function __construct(RegistryInterface $registry, ApcuCache $cache)
    {
        parent::__construct($registry, Product::class);
        $this->cache = $cache;
        $cache->deleteAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByUuidField($value): ?ProductInterface
    {
        if($this->cache->contains('find'.$value)) {
            $query = $this->cache->fetch('find'.$value);
        }
        else {
            $query = $this->createQueryBuilder('p')
                ->andWhere('p.uid = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
            $this->cache->save('find'.$value, $query);
        }
        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function findAllProducts(): array
    {
        if($this->cache->contains('find_all_products')) {
            $query = $this->cache->fetch('find_all_products');
        }
        else {
            $query = $this->createQueryBuilder('p')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
            $this->cache->save('find_all_products', $query);
        }

        return $query;

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
