<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="max-w-2xl mx-auto">

  <div class="flex items-start justify-between gap-4 mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <!-- Plus + calendar icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 4v16m8-8H4" />
        </svg>
        Create Appointment
      </h1>
      <p class="text-sm text-gray-500 mt-1">
        Book a new appointment with an available doctor.
      </p>
    </div>

    <a href="<?= BASE_URL ?>/patient/appointment.php"
      class="text-sm text-blue-600 hover:text-blue-700 font-medium">
      ← Back
    </a>
  </div>

  <!-- Flash -->
  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
      <?= Security::e($_SESSION['flash']); ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
  <?php endif; ?>

  <div class="bg-white rounded-2xl shadow p-8 border border-gray-100">

    <form method="POST" class="space-y-5">
      <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">

      <!-- Doctor -->
      <div>
        <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
          <!-- doctor icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A9 9 0 1119 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Doctor
        </label>
        <select name="doctor_id" required
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-blue-200">
          <option value="">Select doctor</option>
          <?php foreach ($doctors as $d): ?>
            <option value="<?= (int)$d['id'] ?>">
              <?= Security::e($d['first_name'] . ' ' . $d['last_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Date + Time -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
            <!-- calendar -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Date
          </label>
          <input type="date" name="date" required
            class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                        focus:outline-none focus:ring-2 focus:ring-purple-200">
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
            <!-- clock -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Time
          </label>
          <input type="time" name="time" required
            class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                        focus:outline-none focus:ring-2 focus:ring-blue-200">
          <p class="text-xs text-gray-400 mt-1">Default hours: 09:00 - 17:00</p>
        </div>
      </div>

      <!-- Reason -->
      <div>
        <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
          <!-- note icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l4 4v14a2 2 0 01-2 2z" />
          </svg>
          Reason
        </label>
        <input type="text" name="reason" required placeholder="e.g. Headache, checkup..."
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                      focus:outline-none focus:ring-2 focus:ring-green-200">
      </div>

      <!-- Submit -->
      <div class="flex justify-end">
        <button class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 transition flex items-center gap-2">
          <!-- check icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 13l4 4L19 7" />
          </svg>
          Create Appointment
        </button>
      </div>

    </form>

  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>