<?php
namespace App\Repositories;

final class UserRepository extends BaseRepository
{
    public function findByEmail(string $email): ?array {
        $row = $this->q("SELECT * FROM users WHERE email=?", [$email])->fetch();
        return $row ?: null;
    }

    public function allDoctors(): array {
        return $this->q("SELECT id, first_name, last_name FROM users WHERE role='doctor' ORDER BY first_name,last_name")->fetchAll();
    }

    public function allPatients(): array {
        return $this->q("SELECT id, first_name, last_name FROM users WHERE role='patient' ORDER BY first_name,last_name")->fetchAll();
    }

    // Admin CRUD users (simple)
    public function listUsers(): array {
        return $this->q("SELECT id, first_name, last_name, email, username, role FROM users ORDER BY id DESC")->fetchAll();
    }

    public function createUser(array $u): bool {
        $sql = "INSERT INTO users(first_name,last_name,email,username,password,role) VALUES(?,?,?,?,?,?)";
        $stmt = $this->q($sql, [$u['first_name'],$u['last_name'],$u['email'],$u['username'],$u['password'],$u['role']]);
        return $stmt->rowCount() === 1;
    }

    public function deleteUser(int $id): bool {
        $stmt = $this->q("DELETE FROM users WHERE id=?", [$id]);
        return $stmt->rowCount() === 1;
    }
}
