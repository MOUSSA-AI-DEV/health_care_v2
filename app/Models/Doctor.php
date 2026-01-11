<?php
namespace App\Models;

class Doctor extends User
{
    private string $specialization;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $specialization
    ) {
        parent::__construct(
            $firstName,
            $lastName,
            $email,
            $password,
            'doctor'
        );

        $this->specialization = $specialization;
    }

    public function getSpecialization(): string
    {
        return $this->specialization;
    }
}