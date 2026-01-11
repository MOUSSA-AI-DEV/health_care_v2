<?php
namespace App\Repositories;

final class AppointmentRepository extends BaseRepository {

    public function forPatient(int $patientUserId): array {
        return $this->  q("
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


//doctor 

    public function forDoctor(int $doctorUserId):array{


    return $this ->q(
        "  SELECT a.*, u.first_name patient_first,u.last_name patient_last 
        FROM appointments a 
        JOIN users u ON u.id=a.patient_id
        WHERE a.doctor_id=?
        ",[$doctorUserId]
    )->fetchAll();
}

public function cancelAsDoctor(int $appointmentId, int $doctorUserId):bool{
    $stmt=$this->q("UPDATE appointment SET status='cancelled'
    WHERE id=? AND doctor_id=? AND status ='scheduled'",[$appointmentId,$doctorUserId]);
        return $stmt->rowCount() === 1;
}
public function markDone(int $appointmentId, int $doctorUserId): bool {
    $stmt = $this->q("
        UPDATE appointments SET status='done'
        WHERE id=? AND doctor_id=? AND status='scheduled'
    ", [$appointmentId, $doctorUserId]);
    return $stmt->rowCount() === 1;
}
 


public function allWithNames(): array
{
    return $this->q("
        SELECT a.*,
               d.first_name AS doctor_first, d.last_name AS doctor_last,
               p.first_name AS patient_first, p.last_name AS patient_last
        FROM appointments a
        JOIN users d ON d.id = a.doctor_id
        JOIN users p ON p.id = a.patient_id
        ORDER BY a.date DESC, a.time DESC
    ")->fetchAll();
}

public function cancelAsAdmin(int $appointmentId): bool
{
    $stmt = $this->q("
        UPDATE appointments SET status='cancelled'
        WHERE id=? AND status='scheduled'
    ", [$appointmentId]);

    return $stmt->rowCount() === 1;
}

}

   



