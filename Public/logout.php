<?php
require __DIR__ . '/_boot.php';

use App\Core\CSRF;

// ❌ If logout is opened with GET → redirect
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

// ✅ CSRF protection
CSRF::verify($_POST['_csrf'] ?? null);

// ✅ Destroy session
$_SESSION = [];
session_destroy();

// ✅ Redirect to login
header('Location: ' . BASE_URL . '/login.php');
exit;
