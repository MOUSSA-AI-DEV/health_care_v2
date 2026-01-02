<?php
namespace App\Repositories;

class PatientRepository extends BaseRepository
{
    public function findByUserId(int $id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM patients WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
