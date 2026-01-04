<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\PrescriptionRepository;
use App\Repositories\UserRepository;
use App\Repositories\MedicationRepository;

Auth::requireRole(['doctor']);

$presRepo = new PrescriptionRepository();
$userRepo = new UserRepository();
$medRepo  = new MedicationRepository();

$patients = $userRepo->allPatients();     // tu dois l’ajouter si pas encore
$meds     = $medRepo->all();              // tu dois l’ajouter si pas encore

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $patientId   = (int)($_POST['patient_id'] ?? 0);
    $medId       = (int)($_POST['medication_id'] ?? 0);
    $dosage      = trim($_POST['dosage'] ?? '');
    $instructions = trim($_POST['instructions'] ?? '');

    if ($patientId && $medId && $dosage !== '') {
        $presRepo->create(
            Auth::id(),
            $patientId,
            $medId,
            $dosage,
            $instructions
        );
        header('Location: prescriptions.php');
        exit;
    }
}
$prescriptions = $presRepo->forDoctor(Auth::id());   // ← aussi nécessaire

// ✅ LIGNE MANQUANTE (CAUSE DE LA PAGE BLANCHE)
require VIEW_PATH . '/doctor/prescriptions.php';