<?php
namespace App\Repositories;

final class MedicationRepository extends BaseRepository
{
    public function all(): array
    {
        return $this->q("SELECT * FROM medications ORDER BY name")->fetchAll();
    }

    public function create(string $name, string $description): bool
    {
        $stmt = $this->q(
            "INSERT INTO medications (name, description) VALUES (?, ?)",
            [$name, $description]
        );
        return $stmt->rowCount() === 1;
    }

    public function update(int $id, string $name, string $description): bool
    {
        $stmt = $this->q(
            "UPDATE medications SET name=?, description=? WHERE id=?",
            [$name, $description, $id]
        );
        return $stmt->rowCount() === 1;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->q("DELETE FROM medications WHERE id=?", [$id]);
        return $stmt->rowCount() === 1;
    }
}
