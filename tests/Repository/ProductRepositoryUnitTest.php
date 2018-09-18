<?php

declare(strict_types=1);

/**
 * BileMo Project
 *
 * (c) CORROY Alexandre <alexandre.corroy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Repository;

use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Repository\ProductRepository;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ProductRepositoryUnitTest.
 */
final class ProductRepositoryUnitTest extends TestCase
{

    /**
     * @var RegistryInterface|null
     */
    private $registry = null;

    /**
     * @var ApcuCache|null
     */
    private $cache = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->registry = $this->createMock(RegistryInterface::class);
        $this->cache = $this->createMock(ApcuCache::class);
    }

    /**
     * test repository
     */
    public function testRepository()
    {
        $classMetaDataMock = $this->createMock(ClassMetadata::class);
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $entityManagerMock->method('getClassMetaData')->willReturn($classMetaDataMock);
        $this->registry->method('getManagerForClass')->willReturn($entityManagerMock);

        $repository = new ProductRepository($this->registry, $this->cache);

        static::assertInstanceOf(ProductRepositoryInterface::class, $repository);
    }
}
