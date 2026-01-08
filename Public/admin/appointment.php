<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\AppointmentRepository;

Auth::requireRole(['admin']);

$repo = new AppointmentRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) $repo->cancelAsAdmin($id);

    header('Location: appointments.php');
    exit;
}

$appointments = $repo->allWithNames();
require VIEW_PATH . '/admin/appointment.php';
