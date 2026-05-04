<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\User;
use DateTimeImmutable;
use App\Enum\DevicePlatform;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Repository\DeviceRepository;
use App\Service\NotificationService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class NotificationServiceTest extends TestCase
{
    public function testReturnsNotificationForEligibleUser(): void
    {
        $user = $this->createUser(
            id: 1,
            premium: false,
            countryCode: 'ES',
            lastActiveAt: new DateTimeImmutable('-8 days'),
        );

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->method('find')
            ->with(1)
            ->willReturn($user);

        $deviceRepository = $this->createMock(DeviceRepository::class);
        $deviceRepository
            ->method('userHasDeviceByPlatform')
            ->with(1, DevicePlatform::ANDROID)
            ->willReturn(false);

        $service = new NotificationService($userRepository, $deviceRepository);

        $notifications = $service->getNotifications(1);

        self::assertCount(1, $notifications);
        self::assertSame('Configurar dispositivo Android', $notifications[0]->title);
        self::assertSame('https://trendos.com/', $notifications[0]->cta);
    }

    public function testReturnsEmptyArrayWhenUserHasAndroidDevice(): void
    {
        $user = $this->createUser(
            id: 1,
            premium: false,
            countryCode: 'ES',
            lastActiveAt: new DateTimeImmutable('-8 days'),
        );

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->method('find')->willReturn($user);

        $deviceRepository = $this->createMock(DeviceRepository::class);
        $deviceRepository
            ->method('userHasDeviceByPlatform')
            ->with(1, DevicePlatform::ANDROID)
            ->willReturn(true);

        $service = new NotificationService($userRepository, $deviceRepository);

        self::assertSame([], $service->getNotifications(1));
    }

    public function testReturnsEmptyArrayWhenUserIsPremium(): void
    {
        $user = $this->createUser(
            id: 1,
            premium: true,
            countryCode: 'ES',
            lastActiveAt: new DateTimeImmutable('-8 days'),
        );

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->method('find')->willReturn($user);

        $deviceRepository = $this->createMock(DeviceRepository::class);
        $deviceRepository->method('userHasDeviceByPlatform')->willReturn(false);

        $service = new NotificationService($userRepository, $deviceRepository);

        self::assertSame([], $service->getNotifications(1));
    }

    public function testReturnsEmptyArrayWhenUserIsNotFromSpain(): void
    {
        $user = $this->createUser(
            id: 1,
            premium: false,
            countryCode: 'LT',
            lastActiveAt: new DateTimeImmutable('-8 days'),
        );

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->method('find')->willReturn($user);

        $deviceRepository = $this->createMock(DeviceRepository::class);
        $deviceRepository->method('userHasDeviceByPlatform')->willReturn(false);

        $service = new NotificationService($userRepository, $deviceRepository);

        self::assertSame([], $service->getNotifications(1));
    }

    public function testReturnsEmptyArrayWhenUserWasActiveDuringLastWeek(): void
    {
        $user = $this->createUser(
            id: 1,
            premium: false,
            countryCode: 'ES',
            lastActiveAt: new DateTimeImmutable('-2 days'),
        );

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->method('find')->willReturn($user);

        $deviceRepository = $this->createMock(DeviceRepository::class);
        $deviceRepository->method('userHasDeviceByPlatform')->willReturn(false);

        $service = new NotificationService($userRepository, $deviceRepository);

        self::assertSame(
            [],
            $service->getNotifications($user->getId())
        );
    }

    public function testThrowsExceptionWhenUserDoesNotExist(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->method('find')
            ->with(999)
            ->willReturn(null);

        $deviceRepository = $this->createMock(DeviceRepository::class);

        $service = new NotificationService($userRepository, $deviceRepository);

        $this->expectException(NotFoundHttpException::class);

        $service->getNotifications(999);
    }

    private function createUser(
        int $id,
        bool $premium,
        string $countryCode,
        DateTimeImmutable $lastActiveAt,
    ): User {
        $user = $this->createMock(User::class);

        $user->method('getId')->willReturn($id);
        $user->method('isPremium')->willReturn($premium);
        $user->method('getCountryCode')->willReturn($countryCode);
        $user->method('getLastActiveAt')->willReturn($lastActiveAt);

        return $user;
    }
}
