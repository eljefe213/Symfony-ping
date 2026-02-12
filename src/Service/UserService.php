<?php

namespace App\Service;

class UserService
{
    public function getUser(int $id): array
    {
        return [
            'id' => $id,
            'name' => 'Abdel',
        ];
    }
}
