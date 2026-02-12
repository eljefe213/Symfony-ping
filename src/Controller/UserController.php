<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;

readonly class UserController
{
    public function __construct(private UserService $userService)
    {
    }

    #[Route('/api/user/{id}', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $user = $this->userService->getUser($id);

        return new JsonResponse($user);
    }
}
