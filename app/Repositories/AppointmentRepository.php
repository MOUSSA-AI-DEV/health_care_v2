<?php
namespace App\Repositories;

final class AppointmentRepository extends BaseRepository {

    public function forPatient(int $patientUserId): array {
        return $this->q("
            SELECT a.*,
                   u.first_name doctor_first, u.last_name doctor_last
            FROM appointments a
            JOIN users u ON u.id = a.doctor_id
            WHERE a.patient_id = ?
            ORDER BY a.date DESC, a.time DESC
        ", [$patientUserId])->fetchAll();
    }

    public function existsSlot(int $doctorUserId, string $date, string $time): bool {
        $row = $this->q("
            SELECT COUNT(*) c
            FROM appointments
            WHERE doctor_id=? AND date=? AND time=? AND status<>'cancelled'
        ", [$doctorUserId,$date,$time])->fetch();
        return (int)$row['c'] > 0;
    }

    public function create(int $doctorUserId, int $patientUserId, string $date, string $time, string $reason): bool {
        $stmt = $this->q("
            INSERT INTO appointments(date,time,doctor_id,patient_id,reason,status)
            VALUES(?,?,?,?,?,'scheduled')
        ", [$date,$time,$doctorUserId,$patientUserId,$reason]);
        return $stmt->rowCount() === 1;
    }

    public function cancelAsPatient(int $appointmentId, int $patientUserId): bool {
        $stmt = $this->q("
            UPDATE appointments SET status='cancelled'
            WHERE id=? AND patient_id=? AND status='scheduled'
        ", [$appointmentId,$patientUserId]);
        return $stmt->rowCount() === 1;
    }
}
