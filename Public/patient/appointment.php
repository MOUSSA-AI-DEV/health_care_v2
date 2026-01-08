<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\AppointmentRepository;

Auth::requireRole(['patient']);

$repo = new AppointmentRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);
    $id = (int)($_POST['id'] ?? 0);
    $repo->cancelAsPatient($id, Auth::id());
    header('Location: appointment.php'); exit;
}

$appointments = $repo->forPatient(Auth::id());
require VIEW_PATH . '/patient/appointment.php';
