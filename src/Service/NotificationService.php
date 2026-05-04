<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use DateTimeImmutable;
use App\Enum\DevicePlatform;
use App\Dto\NotificationResponse;
use App\Repository\UserRepository;
use App\Repository\DeviceRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class NotificationService
{
    public function __construct(
        private UserRepository $userRepository,
        private DeviceRepository $deviceRepository,
    ) {
    }

    /**
     * @param int $userId
     * @return NotificationResponse[]
     */
    public function getNotifications(int $userId): array
    {
        $user = $this->userRepository->find($userId);

        if ($user === null) {
            throw new NotFoundHttpException('User not found');
        }

        $notifications = [];

        if ($this->isEligibleForAndroidSetup($user)) {
            $notifications[] = new NotificationResponse(
                title: 'Configurar dispositivo Android',
                description: 'Phasellus rhoncus ante dolor, at semper metus aliquam quis. Praesent finibus pharetra libero, ut feugiat mauris dapibus blandit. Donec sit.',
                cta: 'https://trendos.com/',
            );
        }

        return $notifications;
    }

    private function isEligibleForAndroidSetup(User $user): bool
    {
        return !$this->deviceRepository->userHasDeviceByPlatform($user->getId(), DevicePlatform::ANDROID)
            && !$user->isPremium()
            && $user->getCountryCode() === 'ES'
            && $user->getLastActiveAt() < new DateTimeImmutable('-1 week');
    }
}
