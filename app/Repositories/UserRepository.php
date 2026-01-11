<?php
namespace App\Repositories;

final class UserRepository extends BaseRepository {
    public function findByEmail(string $email ): ?array {
      $row = $this->q("SELECT * FROM users WHERE email=? ", [$email])->fetch();
    return $row ?: null;
    }

    public function allDoctors(): array {

        
        return $this->q("
            SELECT u.id, u.first_name, u.last_name
            FROM users u
            JOIN doctors d ON d.user_id = u.id
            WHERE u.role='doctor'
            ORDER BY u.first_name
        ")->fetchAll();
    }

    public function allPatients(): array {
    return $this->q("
        SELECT u.id, u.first_name, u.last_name
        FROM users u
        JOIN patients p ON p.user_id = u.id
        WHERE u.role='patient'
        ORDER BY u.first_name
    ")->fetchAll();
}
public function allByRole(string $role): array
{
    return $this->q("SELECT * FROM users WHERE role=? ORDER BY id DESC", [$role])->fetchAll();
}

public function createUser(string $first, string $last, string $email, string $password, string $role): bool
{
    $stmt = $this->q("
        INSERT INTO users (first_name, last_name, email, password, role)
        VALUES (?, ?, ?, ?, ?)
    ", [$first, $last, $email, $password, $role]);

    return $stmt->rowCount() === 1;
}

public function deleteUser(int $id): bool
{
    $stmt = $this->q("DELETE FROM users WHERE id=?", [$id]);
    return $stmt->rowCount() === 1;
}

}
