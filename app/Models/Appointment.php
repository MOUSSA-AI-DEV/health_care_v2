<?php
namespace App\Models;

class Appointment
{
    private ?int $id = null;

    public function __construct(
        private int $doctorId,
        private int $patientId,
        private string $date,
        private string $time,
        private string $status = 'scheduled'
    ) {}

    public function getDoctorId(): int { return $this->doctorId; }
    public function getPatientId(): int { return $this->patientId; }
    public function getDate(): string { return $this->date; }
    public function getTime(): string { return $this->time; }
    public function getStatus(): string { return $this->status; }
}

?>