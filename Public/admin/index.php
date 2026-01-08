<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;

Auth::requireRole(['admin']);

require VIEW_PATH . '/admin/dashboard.php';
