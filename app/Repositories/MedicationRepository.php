<?php
namespace App\Repositories;

final class MedicationRepository extends BaseRepository
{
    public function all(): array {
        return $this->q("SELECT * FROM medications ORDER BY id DESC")->fetchAll();
    }

    public function create(string $name, string $instructions): bool {
        $stmt = $this->q("INSERT INTO medications(name,instructions) VALUES(?,?)", [$name, $instructions]);
        return $stmt->rowCount() === 1;
    }

    public function delete(int $id): bool {
        $stmt = $this->q("DELETE FROM medications WHERE id=?", [$id]);
        return $stmt->rowCount() === 1;
    }
}
