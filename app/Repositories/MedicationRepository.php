<?php
namespace App\Repositories;

final class MedicationRepository extends BaseRepository
{
    public function all(): array
    {
        return $this->q("
            SELECT *
            FROM medications
            ORDER BY name
        ")->fetchAll();
    }
}
