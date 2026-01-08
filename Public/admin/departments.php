<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\DepartmentRepository;

Auth::requireRole(['admin']);

$repo = new DepartmentRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');

    if ($action === 'create' && $name !== '') $repo->create($name);
    if ($action === 'update' && $id > 0 && $name !== '') $repo->update($id, $name);
    if ($action === 'delete' && $id > 0) $repo->delete($id);

    header('Location: departments.php'); exit;
}

$departments = $repo->all();
require VIEW_PATH . '/admin/departments.php';
