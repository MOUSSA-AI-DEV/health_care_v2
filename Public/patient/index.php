<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;

Auth::requireRole(['patient']);

require VIEW_PATH . '/patient/dashboard.php';
