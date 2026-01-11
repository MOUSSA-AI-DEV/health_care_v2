<?php
require __DIR__ . '/_boot.php';

use App\Core\Auth;
use App\Core\CSRF;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::verify($_POST['_csrf'] ?? null);

    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if (Auth::attempt($email, $pass)) {
        header('Location: index.php'); exit;
    }

    $_SESSION['flash'] = 'Invalid credentials';
    header('Location: login.php'); exit;
}

require VIEW_PATH . '/auth/login.php';
