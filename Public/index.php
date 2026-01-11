<?php
require __DIR__ . '/_boot.php';

use App\Core\Auth;

Auth::requireLogin();

$role = Auth::role();

if ($role === 'admin')  header('Location: '.BASE_URL.'/admin/index.php');
if ($role === 'doctor') header('Location: '.BASE_URL.'/doctor/index.php');
if ($role === 'patient')header('Location: '.BASE_URL.'/patient/index.php');

exit;
