<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Device;
use App\Enum\DevicePlatform;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Device>
 */
class DeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Device::class);
    }

    public function userHasDeviceByPlatform(int $userId, DevicePlatform $devicePlatform): bool
    {
        return $this->createQueryBuilder('d')
                ->select('1')
                ->andWhere('d.user = :userId')
                ->andWhere('d.platform = :platform')
                ->setParameter('userId', $userId)
                ->setParameter('platform', $devicePlatform)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult() !== null;
    }
}
