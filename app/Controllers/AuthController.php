<?php
namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Core\Auth;
use PDO;

class AuthController
{
    private UserRepository $users;

    public function __construct(PDO $pdo)
    {
        $this->users = new UserRepository($pdo);
    }

    public function login()
    {
        require '../views/auth/login.php';
    }

    public function authenticate()
    {
        $user = $this->users->findByEmail($_POST['email']);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            Auth::login($user);

            header('Location: index.php?controller=patient&action=dashboard');
            exit;
        }

        die('Invalid credentials');
    }

    public function logout()
    {
        Auth::logout();
        header('Location: index.php');
    }
}
