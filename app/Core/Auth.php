<?php
namespace App\Core;

use App\Repositories\UserRepository;

final class Auth
{
    public static function check(): bool { return isset($_SESSION['user']); }
    public static function id(): int { return (int)($_SESSION['user']['id'] ?? 0); }
    public static function role(): string { return $_SESSION['user']['role'] ?? 'guest'; }

    public static function requireLogin(): void {
        if (!self::check()) { header('Location: /login.php'); exit; }
    }

    public static function requireRole(array $roles): void {
        self::requireLogin();
        if (!in_array(self::role(), $roles, true)) {
            http_response_code(403);
            exit('Access denied');
        }
    }

 public static function attempt(string $email, string $password): bool
{
    $repo = new UserRepository();
    $u = $repo->findByEmail($email);

    if (!$u) return false;

    if (($u['password'] ?? '') !== $password) return false;

    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => (int)$u['id'],
        'role' => $u['role'],
        'email' => $u['email'],
    ];

    return true;
}

    public static function logout(): void {
        session_destroy();
        header('Location: /login.php');
        exit;
    }
}
