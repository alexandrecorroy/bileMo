<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Repository\Interfaces\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Cache\ApcuCache;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CustomerRepository.
 */
final class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
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
        parent::__construct($registry, Customer::class);
        $this->cache = $cache;
        $cache->deleteAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getOneCustomer(): ?Customer
    {
        if($this->cache->contains('customer')) {
            $query = $this->cache->fetch('customer');
        } else {
            $query = $this->createQueryBuilder('c')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
            $this->cache->save('customer', $query);
        }
        return $query;
    }
}
