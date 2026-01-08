<?php
require __DIR__ . '/../_boot.php';

use App\Core\Auth;
use App\Repositories\StatsRepository;

Auth::requireRole(['doctor']);

$repo = new StatsRepository();

$byStatus = $repo->appointmentsByStatusForDoctor(Auth::id());
$topMeds  = $repo->topMedicationsForDoctor(Auth::id(), 5);

require VIEW_PATH . '/doctor/statistics.php';
