<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\Mailer\MailerService;

class WelcomeController
{
    public function __construct(private MailerService $mailer) {}

    #[Route('/api/welcome', name: 'api_welcome', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data) || !isset($data['email']) || !is_string($data['email'])) {
            return new JsonResponse(['error' => 'Missing email'], 400);
        }

        $email = trim($data['email']);
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new JsonResponse(['error' => 'Invalid email'], 400);
        }

        $this->mailer->welcome($email);

        return new JsonResponse(['success' => 'Welcome!'], 200);
    }
}
