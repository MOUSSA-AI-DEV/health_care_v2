<?php require __DIR__ . '/../_boot.php';

use App\Core\Auth;
Auth::requireRole(['doctor']);

require VIEW_PATH . '/doctor/dashboard.php';
