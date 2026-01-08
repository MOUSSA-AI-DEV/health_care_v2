<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\UserRepository;
use App\Repositories\AppointmentRepository;

Auth::requireRole(['patient']);

$userRepo = new UserRepository();
$apptRepo = new AppointmentRepository();
$doctors  = $userRepo->allDoctors();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $doctorId = (int)($_POST['doctor_id'] ?? 0);
    $date = trim($_POST['date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $reason = trim($_POST['reason'] ?? '');

    if ($doctorId && $date && $time && $reason) {
        if (!$apptRepo->existsSlot($doctorId, $date, $time)) {
            $apptRepo->create($doctorId, Auth::id(), $date, $time, $reason);
            header('Location:  create.php'); exit;
        }
        $_SESSION['flash'] = 'Slot already taken';
    } else {
        $_SESSION['flash'] = 'Please fill all fields';
    }
}

require VIEW_PATH . '/appointments/create.php';
