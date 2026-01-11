<?php
namespace App\Repositories;

final class StatsRepository extends BaseRepository
{



    public function appointmentsByStatus(): array
    {
        return $this->q("
            SELECT status, COUNT(*) AS total
            FROM appointments
            GROUP BY status
        ")->fetchAll();
    }

    //RDV par médecin


    public function appointmentsByDoctor(): array
    {
        return $this->q("
            SELECT a.doctor_id,
                   CONCAT(u.first_name, ' ', u.last_name) AS doctor_name,
                   COUNT(*) AS total
            FROM appointments a
            JOIN users u ON u.id = a.doctor_id
            GROUP BY a.doctor_id, doctor_name
            ORDER BY total DESC
        ")->fetchAll();
    }

    //evolution mensuelle des RDV
    public function appointmentsMonthly(): array
    {
        return $this->q("
            SELECT DATE_FORMAT(date, '%Y-%m') AS month,
                   COUNT(*) AS total
            FROM appointments
            GROUP BY month
            ORDER BY month ASC
        ")->fetchAll();
    }

    // Médicaments les plus prescrits

    public function topMedications(int $limit = 5): array
    {
        $limit = max(1, min($limit, 20)); 
        return $this->q("
            SELECT m.name AS medication_name,
                   COUNT(*) AS total
            FROM prescriptions pr
            JOIN medications m ON m.id = pr.medication_id
            GROUP BY pr.medication_id, medication_name
            ORDER BY total DESC
            LIMIT $limit
        ")->fetchAll();
    }


    /* --------- DOCTOR STATS (LIMITÉES) --------- */   



    public function appointmentsByStatusForDoctor(int $doctorId): array
    {
        return $this->q("
            SELECT status, COUNT(*) AS total
            FROM appointments
            WHERE doctor_id = ?
            GROUP BY status
        ", [$doctorId])->fetchAll();
    }

    public function topMedicationsForDoctor(int $doctorId, int $limit = 5): array
    {
        $limit = max(1, min($limit, 20));
        return $this->q("
            SELECT m.name AS medication_name,
                   COUNT(*) AS total
            FROM prescriptions pr
            JOIN medications m ON m.id = pr.medication_id
            WHERE pr.doctor_id = ?
            GROUP BY pr.medication_id, medication_name
            ORDER BY total DESC
            LIMIT $limit
        ", [$doctorId])->fetchAll();
    }
}
