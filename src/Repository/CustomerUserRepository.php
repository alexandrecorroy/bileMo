<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\CustomerUser;
use App\Entity\Interfaces\CustomerUserInterface;
use App\Entity\Product;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Cache\ApcuCache;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * final Class CustomerUserRepository.
 */
final class CustomerUserRepository extends ServiceEntityRepository implements CustomerUserRepositoryInterface
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
        parent::__construct($registry, CustomerUser::class);
        $this->cache = $cache;
        $cache->deleteAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByUuidField($value): ?CustomerUserInterface
    {
        if($this->cache->contains('find'.$value)) {
            $query = $this->cache->fetch('find'.$value);
        }
        else {
            $query = $this->createQueryBuilder('cu')
                ->andWhere('cu.uid = :val')
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
    public function findAllCustomerUser(): array
    {
        // TODO: Implement findAllCustomerUser() method.
    }

    /**
     * {@inheritdoc}
     */
    public function findOtherCustomerUser(CustomerUserInterface $customerUser): ?CustomerUserInterface
    {
        // TODO: Implement findOtherCustomerUser() method.
    }


}
