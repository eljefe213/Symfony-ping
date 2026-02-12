<?php

namespace App\Service;

class UserService
{
    public function __construct(private LoggerService $logger)
    {

    }
    public function getUser(int $id): array
    {
        $this->logger->log("Fetching user $id");

        return [
            'id' => $id,
            'name' => 'Abdel',
        ];
    }
}
