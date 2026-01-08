<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Repositories\StatsRepository;

Auth::requireRole(['admin']);

$repo = new StatsRepository();

$byStatus  = $repo->appointmentsByStatus();
$byDoctor  = $repo->appointmentsByDoctor();
$monthly   = $repo->appointmentsMonthly();
$topMeds   = $repo->topMedications(5);

require VIEW_PATH . '/admin/statistics.php';
