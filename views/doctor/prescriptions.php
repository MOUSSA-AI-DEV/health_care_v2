<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex items-start justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <!-- Document icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l4 4v14a2 2 0 01-2 2z" />
      </svg>
      Doctor Prescriptions
    </h1>
    <p class="text-sm text-gray-500 mt-1">Create prescriptions and view your history.</p>
  </div>
</div>

<?php if (!empty($_SESSION['flash'])): ?>
  <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
    <?= Security::e($_SESSION['flash']); ?>
  </div>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<!-- CREATE FORM -->
<div class="bg-white rounded-xl shadow p-6 border border-gray-100 mb-8">
  <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-4">
    <!-- Plus icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4v16m8-8H4" />
    </svg>
    Create Prescription
  </h2>

  <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">

    <!-- Patient -->
    <div>
      <label class="text-sm font-medium text-gray-700">Patient</label>
      <select name="patient_id" required
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-200">
        <option value="">Select patient</option>
        <?php foreach ($patients as $p): ?>
          <option value="<?= (int)$p['id'] ?>">
            <?= Security::e($p['first_name'] . ' ' . $p['last_name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Medication -->
    <div>
      <label class="text-sm font-medium text-gray-700">Medication</label>
      <select name="medication_id" required
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-200">
        <option value="">Select medication</option>
        <?php foreach ($meds as $m): ?>
          <option value="<?= (int)$m['id'] ?>">
            <?= Security::e($m['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Dosage -->
    <div>
      <label class="text-sm font-medium text-gray-700">Dosage</label>
      <input type="text" name="dosage" required
        placeholder="e.g. 1 pill / day"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-200">
    </div>

    <!-- Instructions -->
    <div>
      <label class="text-sm font-medium text-gray-700">Instructions</label>
      <textarea name="instructions" rows="2"
        placeholder="Optional instructions..."
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-200"></textarea>
    </div>

    <div class="md:col-span-2 flex justify-end">
      <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <!-- Check icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 13l4 4L19 7" />
        </svg>
        Create
      </button>
    </div>
  </form>
</div>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow overflow-x-auto border border-gray-100">
  <div class="p-5 border-b flex items-center justify-between">
    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
      <!-- List icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      My Prescriptions
    </h2>
  </div>

  <table class="w-full text-sm">
    <thead class="bg-gray-100 text-gray-600">
      <tr>
        <th class="p-4 text-left">Patient</th>
        <th class="p-4 text-left">Medication</th>
        <th class="p-4 text-left">Dosage</th>
        <th class="p-4 text-left">Instructions</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($prescriptions as $pr): ?>
        <tr class="border-b hover:bg-gray-50">
          <td class="p-4 font-medium">
            <?= Security::e($pr['patient_first'] . ' ' . $pr['patient_last']) ?>
          </td>
          <td class="p-4">
            <?= Security::e($pr['medication_name'] ?? $pr['name'] ?? '') ?>
          </td>
          <td class="p-4">
            <?= Security::e($pr['dosage']) ?>
          </td>
          <td class="p-4 text-gray-600">
            <?= Security::e($pr['instructions'] ?? '-') ?>
          </td>
        </tr>
      <?php endforeach; ?>

      <?php if (empty($prescriptions)): ?>
        <tr>
          <td colspan="4" class="p-6 text-center text-gray-500">
            No prescriptions yet.
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>