<?php
namespace App\Models;

abstract class User
{
    protected ?int $id = null;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $password;
    protected string $role;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $role
    ) {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->email     = $email;
        $this->password  = $password;
        $this->role      = $role;
    }

    // === Getters ===
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    // === Setter pour l'ID (utilisé après insertion DB) ===
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}