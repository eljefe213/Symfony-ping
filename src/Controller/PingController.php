<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PingController
{
    #[Route('/api/ping', name: 'ping', methods: ['GET'])]
    public function ping(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'OK',
        ]);
    }
}
