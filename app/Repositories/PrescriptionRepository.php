<?php

namespace App\Repositories;

final class PrescriptionRepository extends BaseRepository {

    public function forPatient(int $patientUserId): array {
        return $this->q("
            SELECT pr.*,
                   m.name medication_name,
                   d.first_name doctor_first, d.last_name doctor_last
            FROM prescriptions pr
            JOIN medications m ON m.id = pr.medication_id
            JOIN users d ON d.id = pr.doctor_id
            WHERE pr.patient_id = ?
            ", [$patientUserId])->fetchAll();
        }


        // for doctore

     public function forDoctor(int $doctorUserId): array
{
    return $this->q("
        SELECT pr.*,
               m.name AS medication_name,
               u.first_name AS patient_first,
               u.last_name  AS patient_last
        FROM prescriptions pr
        JOIN medications m ON m.id = pr.medication_id
        JOIN users u ON u.id = pr.patient_id
        WHERE pr.doctor_id = ?
        ORDER BY pr.created_at DESC
    ", [$doctorUserId])->fetchAll();
}

public function create(
    int $doctorId,
    int $patientId,
    int $medicationId,
    string $dosage,
    string $instructions
): bool {
    $stmt = $this->q("
        INSERT INTO prescriptions (doctor_id, patient_id, medication_id, dosage, instructions)
        VALUES (?, ?, ?, ?, ?)
    ", [$doctorId, $patientId, $medicationId, $dosage, $instructions]);

    return $stmt->rowCount() === 1;
}


    }
    