<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Repository\Interfaces\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CustomerRepository.
 */
final class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Customer::class);
    }

    /**
     * {@inheritdoc}
     */
    public function create($entity): void
    {
        $this->_em->persist($entity);
        $this::save();
    }

    /**
     * {@inheritdoc}
     */
    public function save(): void
    {
        $this->_em->flush();
    }
}
