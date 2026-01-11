<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
  <div>
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <!-- Shield icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-indigo-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 3l8 4v6c0 5-3.5 9.5-8 10-4.5-.5-8-5-8-10V7l8-4z" />
      </svg>
      Admin Dashboard
    </h1>
    <p class="text-sm text-gray-500 mt-1">
      Manage clinic operations, users, and system data securely.
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
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

  <!-- Statistics -->
  <a href="<?= BASE_URL ?>/admin/statistics.php"
    class="bg-white rounded-xl shadow p-6 hover:shadow-md transition border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-purple-600 font-semibold">Analytics</div>
      <!-- Chart icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 3v18m4-14v14m4-10v10M7 13v8M3 17v4" />
      </svg>
    </div>
    <h2 class="text-lg font-bold mt-2 text-gray-800">Statistics</h2>
    <p class="text-sm text-gray-500 mt-1">Appointments overview and top medications.</p>
    <div class="mt-4 text-sm font-medium text-purple-600">Open →</div>
  </a>

  <!-- Appointments -->
  <a href="<?= BASE_URL ?>/admin/appointment.php"
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
    <h2 class="text-lg font-bold mt-2 text-gray-800">All appointments</h2>
    <p class="text-sm text-gray-500 mt-1">View and cancel scheduled appointments.</p>
    <div class="mt-4 text-sm font-medium text-blue-600">Open →</div>
  </a>

  <!-- Medications -->
  <a href="<?= BASE_URL ?>/admin/medications.php"
    class="bg-white rounded-xl shadow p-6 hover:shadow-md transition border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-green-600 font-semibold">Medications</div>
      <!-- Pill icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 14l-2 2m0 0l-2-2m2 2V8m11 6a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <h2 class="text-lg font-bold mt-2 text-gray-800">Manage medications</h2>
    <p class="text-sm text-gray-500 mt-1">CRUD for the medication catalog.</p>
    <div class="mt-4 text-sm font-medium text-green-600">Open →</div>
  </a>

  <!-- Departments -->
  <a href="<?= BASE_URL ?>/admin/departments.php"
    class="bg-white rounded-xl shadow p-6 hover:shadow-md transition border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-orange-600 font-semibold">Departments</div>
      <!-- Building icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-orange-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 21h18M5 21V7a2 2 0 012-2h10a2 2 0 012 2v14M9 21V9h6v12" />
      </svg>
    </div>
    <h2 class="text-lg font-bold mt-2 text-gray-800">Manage departments</h2>
    <p class="text-sm text-gray-500 mt-1">Organize clinic structure by departments.</p>
    <div class="mt-4 text-sm font-medium text-orange-600">Open →</div>
  </a>

  <!-- Users -->
  <a href="<?= BASE_URL ?>/admin/users.php"
    class="bg-white rounded-xl shadow p-6 hover:shadow-md transition border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-gray-800 font-semibold">Users</div>
      <!-- Users icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-800" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 10-6 0 3 3 0 006 0z" />
      </svg>
    </div>
    <h2 class="text-lg font-bold mt-2 text-gray-800">Manage users</h2>
    <p class="text-sm text-gray-500 mt-1">Admin, doctors, and patients management.</p>
    <div class="mt-4 text-sm font-medium text-gray-800">Open →</div>
  </a>

</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>