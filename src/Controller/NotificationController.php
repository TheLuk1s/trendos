<?php

namespace App\Controller;

use App\Dto\NotificationResponse;
use App\Service\NotificationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final readonly class NotificationController
{
    public function __construct(
        private NotificationService $notificationService,
    ) {
    }

    #[Route('/notifications', name: 'notifications_index', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $userId = $request->query->getInt('user_id');
        $notifications = $this->notificationService->getNotifications($userId);

        return new JsonResponse(
            array_map(
                fn (NotificationResponse $n) => $n->toArray(),
                $notifications
            )
        );
    }
}
