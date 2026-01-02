<?php
namespace App\Repositories;

class UserRepository extends BaseRepository
{
    public function findByEmail(string $email)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM users WHERE email = ?"
        );
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
