<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Repositories\PrescriptionRepository;

Auth::requireRole(['patient']);

$repo = new PrescriptionRepository();
$prescriptions = $repo->forPatient(Auth::id());

require VIEW_PATH . '/patient/prescription.php';
