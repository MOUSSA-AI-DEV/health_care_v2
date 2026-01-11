<?php

use App\Core\Security;
use App\Core\CSRF;

$pageTitle = "Doctor Dashboard";
?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <!-- Stethoscope icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 3v6a4 4 0 004 4h0a4 4 0 004-4V3M8 13v6a4 4 0 004 4h2a4 4 0 004-4v-2m0 0a3 3 0 10-6 0 3 3 0 006 0z" />
            </svg>
            Doctor Dashboard
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Manage your appointments, prescriptions, and track your activity.
        </p>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/logout.php">
        <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
        <button type="submit"
            class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition flex items-center gap-2">
            <!-- Logout icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
            </svg>
            Logout
        </button>
    </form>
</div>

<!-- Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Appointments -->
    <a href="<?= BASE_URL ?>/doctor/appointment.php"
        class="bg-white rounded-xl shadow p-6 hover:shadow-md transition border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="text-blue-600 font-semibold">Appointments</div>
            <!-- Calendar icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <h2 class="text-lg font-bold mt-2 text-gray-800">My Appointments</h2>
        <p class="text-sm text-gray-500 mt-1">View, cancel, or mark appointments as done.</p>
        <div class="mt-4 text-sm font-medium text-blue-600">Open →</div>
    </a>

    <!-- Prescriptions -->
    <a href="<?= BASE_URL ?>/doctor/prescriptions.php"
        class="bg-white rounded-xl shadow p-6 hover:shadow-md transition border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="text-green-600 font-semibold">Prescriptions</div>
            <!-- Document icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l4 4v14a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h2 class="text-lg font-bold mt-2 text-gray-800">My Prescriptions</h2>
        <p class="text-sm text-gray-500 mt-1">Create and manage prescriptions for patients.</p>
        <div class="mt-4 text-sm font-medium text-green-600">Open →</div>
    </a>
    <!-- Statistics -->
    <a href="<?= BASE_URL ?>/doctor/statisticts.php"
        class="bg-white rounded-xl shadow p-6 hover:shadow-md transition border border-gray-100">
        <div class="flex items-center justify-between">
            <div class="text-purple-600 font-semibold">Statistics</div>
            <!-- Chart icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3v18m4-14v14m4-10v10M7 13v8M3 17v4" />
            </svg>
        </div>
        <h2 class="text-lg font-bold mt-2 text-gray-800">My Statistics</h2>
        <p class="text-sm text-gray-500 mt-1">Track your activity and top medications.</p>
        <div class="mt-4 text-sm font-medium text-purple-600">Open →</div>
    </a>

</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>