<?php
namespace App\Core;

class Auth
{
    public static function login(array $user)
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'role' => $user['role']
        ];
    }

    public static function check()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public static function logout()
    {
        session_destroy();
    }
}
