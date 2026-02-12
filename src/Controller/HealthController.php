<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthController
{
    #[Route('/api/health', methods: ['GET'])]
    public function health(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'ok',
        ]);
    }
}
