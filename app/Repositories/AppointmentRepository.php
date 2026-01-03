<?php
namespace App\Repositories;

final class AppointmentRepository extends BaseRepository
{
    public function all(): array {
        return $this->q("
            SELECT a.*,
            d.first_name doctor_first, d.last_name doctor_last,
            p.first_name patient_first, p.last_name patient_last
            FROM appointments a
            JOIN users d ON d.id=a.doctor_id
            JOIN users p ON p.id=a.patient_id
            ORDER BY a.date DESC, a.time DESC
        ")->fetchAll();
    }

    public function forDoctor(int $doctorId): array {
        return $this->q("
            SELECT a.*,
            p.first_name patient_first, p.last_name patient_last
            FROM appointments a
            JOIN users p ON p.id=a.patient_id
            WHERE a.doctor_id=?
            ORDER BY a.date DESC, a.time DESC
        ", [$doctorId])->fetchAll();
    }

    public function forPatient(int $patientId): array {
        return $this->q("
            SELECT a.*,
            d.first_name doctor_first, d.last_name doctor_last
            FROM appointments a
            JOIN users d ON d.id=a.doctor_id
            WHERE a.patient_id=?
            ORDER BY a.date DESC, a.time DESC
        ", [$patientId])->fetchAll();
    }

    public function existsSlot(int $doctorId, string $date, string $time): bool {
        $row = $this->q("
            SELECT COUNT(*) c FROM appointments
            WHERE doctor_id=? AND date=? AND time=? AND status<>'cancelled'
        ", [$doctorId, $date, $time])->fetch();
        return (int)$row['c'] > 0;
    }

    public function create(int $doctorId, int $patientId, string $date, string $time, string $reason): bool {
        $stmt = $this->q("
            INSERT INTO appointments(date,time,doctor_id,patient_id,reason,status)
            VALUES(?,?,?,?,?,'scheduled')
        ", [$date, $time, $doctorId, $patientId, $reason]);
        return $stmt->rowCount() === 1;
    }

    // Patient annule les siens
    public function cancelAsPatient(int $appointmentId, int $patientId): bool {
        $stmt = $this->q("
            UPDATE appointments SET status='cancelled'
            WHERE id=? AND patient_id=? AND status='scheduled'
        ", [$appointmentId, $patientId]);
        return $stmt->rowCount() === 1;
    }

    // Doctor annule les siens
    public function cancelAsDoctor(int $appointmentId, int $doctorId): bool {
        $stmt = $this->q("
            UPDATE appointments SET status='cancelled'
            WHERE id=? AND doctor_id=? AND status='scheduled'
        ", [$appointmentId, $doctorId]);
        return $stmt->rowCount() === 1;
    }

    // Admin annule n’importe quel RDV
    public function cancelAsAdmin(int $appointmentId): bool {
        $stmt = $this->q("
            UPDATE appointments SET status='cancelled'
            WHERE id=? AND status='scheduled'
        ", [$appointmentId]);
        return $stmt->rowCount() === 1;
    }

    public function markDone(int $appointmentId, int $doctorId): bool {
        $stmt = $this->q("
            UPDATE appointments SET status='done'
            WHERE id=? AND doctor_id=? AND status='scheduled'
        ", [$appointmentId, $doctorId]);
        return $stmt->rowCount() === 1;
    }
}
