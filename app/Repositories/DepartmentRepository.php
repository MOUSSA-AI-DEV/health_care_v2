<?php
namespace App\Repositories;

final class DepartmentRepository extends BaseRepository
{
    public function all(): array {
        return $this->q("SELECT * FROM departments ORDER BY name")->fetchAll();
    }

    public function create(string $name): bool {
        $stmt = $this->q("INSERT INTO departments (name) VALUES (?)", [$name]);
        return $stmt->rowCount() === 1;
    }

    public function update(int $id, string $name): bool {
        $stmt = $this->q("UPDATE departments SET name=? WHERE id=?", [$name,$id]);
        return $stmt->rowCount() === 1;
    }

    public function delete(int $id): bool {
        $stmt = $this->q("DELETE FROM departments WHERE id=?", [$id]);
        return $stmt->rowCount() === 1;
    }
}
