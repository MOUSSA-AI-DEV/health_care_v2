<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
  <!-- Calendar Icon -->
  <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none"
    viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
  </svg>
  My Appointments
</h1>

<div class="bg-white rounded-xl shadow overflow-x-auto">

  <table class="w-full text-sm">
    <thead class="bg-gray-100 text-gray-600">
      <tr>
        <th class="p-4 text-left">Date</th>
        <th class="p-4 text-left">Time</th>
        <th class="p-4 text-left">Patient</th>
        <th class="p-4 text-left">Reason</th>
        <th class="p-4 text-left">Status</th>
        <th class="p-4 text-left">Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($appointments as $a): ?>
        <tr class="border-b hover:bg-gray-50">

          <td class="p-4"><?= Security::e($a['date']) ?></td>
          <td class="p-4"><?= Security::e($a['time']) ?></td>

          <td class="p-4 font-medium">
            <?= Security::e(($a['patient_first'] ?? '') . ' ' . ($a['patient_last'] ?? '')) ?>
          </td>

          <td class="p-4 text-gray-600">
            <?= Security::e($a['reason'] ?? '-') ?>
          </td>

          <!-- STATUS BADGE -->
          <td class="p-4">
            <?php
            $status = $a['status'] ?? '';
            $badge = 'bg-gray-200 text-gray-700';
            if ($status === 'scheduled') $badge = 'bg-blue-100 text-blue-700';
            if ($status === 'done') $badge = 'bg-green-100 text-green-700';
            if ($status === 'cancelled') $badge = 'bg-red-100 text-red-700';
            ?>
            <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $badge ?>">
              <?= Security::e($status) ?>
            </span>
          </td>

          <!-- ACTIONS -->
          <td class="p-4">
            <?php if ($status === 'scheduled'): ?>
              <div class="flex gap-2">

                <!-- DONE -->
                <form method="POST">
                  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                  <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                  <input type="hidden" name="action" value="done">
                  <button class="flex items-center gap-1 bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600 text-xs">
                    <!-- Check Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7" />
                    </svg>
                    Done
                  </button>
                </form>

                <!-- CANCEL -->
                <form method="POST">
                  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                  <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                  <input type="hidden" name="action" value="cancel">
                  <button class="flex items-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-xs">
                    <!-- X Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                  </button>
                </form>

              </div>
            <?php else: ?>
              <span class="text-gray-400 text-sm">—</span>
            <?php endif; ?>
          </td>

        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>