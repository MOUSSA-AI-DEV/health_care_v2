<?php
namespace App\Models;

abstract class User
{
    protected int $id;
    protected string $email;
    protected string $role;

    public function getId(): int { return $this->id; }
    public function getRole(): string { return $this->role; }
}
