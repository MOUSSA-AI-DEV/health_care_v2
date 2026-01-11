<?php
namespace App\Models;

class Admin extends User
{
    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ) {
        parent::__construct(
            $firstName,
            $lastName,
            $email,
            $password,
            'admin'
        );
    }
}