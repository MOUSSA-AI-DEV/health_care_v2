<?php

use App\Core\Auth;
use App\Core\Security;

$role = Auth::role(); // admin | doctor | patient | null
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Unity Care Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons (Heroicons) -->
    <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>
    <style>
        .nav-link {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            color: #374151;
        }

        .nav-link:hover {
            background-color: #f3f4f6;
        }
    </style>

</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <!-- Hospital Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-9 h-9 text-blue-600"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 21h18M4 21V5a2 2 0 012-2h12a2 2 0 012 2v16M9 21V9h6v12M12 12v6M10 15h4" />
                </svg>

                <div>
                    <h1 class="text-lg font-bold text-gray-800">Unity Care Clinic</h1>
                    <p class="text-xs text-gray-500">Healthcare Management System</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex items-center gap-4 text-sm font-medium">

                <?php if (Auth::check()): ?>

                    <?php if ($role === 'admin'): ?>
                        <a href="<?= BASE_URL ?>/admin/index.php" class="nav-link">Dashboard</a>
                        <a href="<?= BASE_URL ?>/admin/appointment.php" class="nav-link">Appointments</a>
                        <a href="<?= BASE_URL ?>/admin/medications.php" class="nav-link">Medications</a>
                        <a href="<?= BASE_URL ?>/admin/users.php" class="nav-link">Users</a>
                        <a href="<?= BASE_URL ?>/admin/statistics.php" class="nav-link">Statistics</a>
                    <?php endif; ?>

                    <?php if ($role === 'doctor'): ?>
                        <a href="<?= BASE_URL ?>/doctor/index.php" class="nav-link">Dashboard</a>
                        <a href="<?= BASE_URL ?>/doctor/appointment.php" class="nav-link">Appointments</a>
                        <a href="<?= BASE_URL ?>/doctor/prescriptions.php" class="nav-link">Prescriptions</a>
                    <?php endif; ?>

                    <?php if ($role === 'patient'): ?>
                        <a href="<?= BASE_URL ?>/patient/index.php" class="nav-link">Dashboard</a>
                        <a href="<?= BASE_URL ?>/patient/appointment.php" class="nav-link">Appointments</a>
                        <a href="<?= BASE_URL ?>/patient/prescription.php" class="nav-link">Prescriptions</a>
                    <?php endif; ?>

                    <form method="POST" action="<?= BASE_URL ?>/logout.php" class="inline">
                        <button class="ml-4 px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>

                <?php else: ?>
                    <a href="<?= BASE_URL ?>/login.php"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        Login
                    </a>
                <?php endif; ?>

            </nav>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1 max-w-7xl mx-auto px-6 py-8">