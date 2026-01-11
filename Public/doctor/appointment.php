<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\AppointmentRepository;

Auth::requireRole(['doctor']);

$repo = new AppointmentRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $id = (int)($_POST['id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($id > 0) {
        if ($action === 'cancel') {
            $repo->cancelAsDoctor($id, Auth::id());
        } elseif ($action === 'done') {

            $repo ->markDone($id, Auth::id());
        }
    }

    header('Location: appointment.php');
    exit;
}

$appointments = $repo->forDoctor(Auth::id());

require VIEW_PATH . '/doctor/appointment.php';
