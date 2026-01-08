<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Core\CSRF;
use App\Repositories\UserRepository;

Auth::requireRole(['admin']);

$repo = new UserRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $first = trim($_POST['first_name'] ?? '');
        $last  = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pass  = trim($_POST['password'] ?? '');
        $role  = $_POST['role'] ?? 'patient';

        if ($first && $last && $email && $pass && in_array($role, ['doctor','patient'], true)) {
            $repo->createUser($first, $last, $email, $pass, $role);
        }
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) $repo->deleteUser($id);
    }

    header('Location: users.php'); exit;
}

$doctors  = $repo->allByRole('doctor');
$patients = $repo->allByRole('patient');

require VIEW_PATH . '/admin/users.php';
