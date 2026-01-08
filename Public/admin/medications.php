<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\MedicationRepository;

Auth::requireRole(['admin']);

$repo = new MedicationRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($action === 'create' && $name !== '') $repo->create($name, $description);
    if ($action === 'update' && $id > 0 && $name !== '') $repo->update($id, $name, $description);
    if ($action === 'delete' && $id > 0) $repo->delete($id);

    header('Location: medications.php');
    exit;
}

$meds = $repo->all();
require VIEW_PATH . '/admin/medications.php';
