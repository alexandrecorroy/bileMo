<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\CustomerUser;
use App\Entity\Interfaces\CustomerUserInterface;
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
    public function findAllCustomerUser(Customer $customer): ?array
    {
        $customerUid = $customer->getUid()->toString();
        if($this->cache->contains('findAllCustomerUser' . $customerUid)) {
            $query = $this->cache->fetch('findAllCustomerUser' . $customerUid);
        } else {
            $query = $this->createQueryBuilder('cu')
                ->where('cu.customer = :customer')
                ->setParameter('customer', $customerUid)
                ->setMaxResults(10)
                ->getQuery()
                ->getResult();
            $this->cache->save('findAllCustomerUser' . $customerUid, $query);
        }
        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function findOtherCustomerUser(CustomerUserInterface $customerUser): ?CustomerUserInterface
    {
        return $this->createQueryBuilder('cu')
            ->where('cu.email = :email')
            ->setParameters(array(
                'email'      => $customerUser->getEmail()
            ))
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
