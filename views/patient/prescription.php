<?php

use App\Core\Security; ?>
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
      My Prescriptions
    </h1>
    <p class="text-sm text-gray-500 mt-1">
      View all prescriptions issued by your doctors.
    </p>
  </div>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-100 text-gray-600">
        <tr>
          <th class="p-4 text-left whitespace-nowrap">Doctor</th>
          <th class="p-4 text-left whitespace-nowrap">Medication</th>
          <th class="p-4 text-left whitespace-nowrap">Dosage</th>
          <th class="p-4 text-left">Instructions</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-100">
        <?php if (!empty($prescriptions)): ?>
          <?php foreach ($prescriptions as $p): ?>
            <tr class="hover:bg-gray-50">
              <td class="p-4 font-medium whitespace-nowrap">
                <?= Security::e(($p['doctor_first'] ?? '') . ' ' . ($p['doctor_last'] ?? '')) ?>
              </td>

              <td class="p-4 whitespace-nowrap">
                <?= Security::e($p['medication_name'] ?? '-') ?>
              </td>

              <td class="p-4 whitespace-nowrap">
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                  <!-- pill icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 14l-2 2m0 0l-2-2m2 2V8m11 6a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <?= Security::e($p['dosage'] ?? '-') ?>
                </span>
              </td>

              <td class="p-4 text-gray-600">
                <?= Security::e($p['instructions'] ?? '-') ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="p-6 text-center text-gray-500">
              No prescriptions found.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>