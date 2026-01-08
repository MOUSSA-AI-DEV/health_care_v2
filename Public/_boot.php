<?php
session_start();
define('BASE_URL', '/health_care_v2/public');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Config/config.php';

/* load .env simple */
$envPath = BASE_PATH . '/.env';
if (file_exists($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        [$k, $v] = array_pad(explode('=', $line, 2), 2, '');
        $_ENV[trim($k)] = trim($v);
    }
}
// debug temporaire