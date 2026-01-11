<?php
namespace App\Models;

class Patient extends User
{
    private string $address;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $address
    ) {
        parent::__construct(
            $firstName,
            $lastName,
            $email,
            $password,
            'patient'
        );

        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
