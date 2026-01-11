<?php

use App\Core\Security;
use App\Core\CSRF;

$pageTitle = "My Appointments";
?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex items-start justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      My Appointments
    </h1>
    <p class="text-sm text-gray-500 mt-1">View and manage your medical appointments.</p>
  </div>

  <a href="<?= BASE_URL ?>/appointments/create.php"
    class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4v16m8-8H4" />
    </svg>
    New Appointment
  </a>
</div>

<!-- Flash message -->
<?php if (!empty($_SESSION['flash'])): ?>
  <div class="mb-6 p-4 rounded-lg border
              <?= (str_starts_with($_SESSION['flash'], 'OK')) ? 'bg-green-50 border-green-200 text-green-700' : 'bg-red-50 border-red-200 text-red-700' ?>">
    <?= Security::e($_SESSION['flash']) ?>
  </div>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-100 text-gray-600">
        <tr>
          <th class="p-4 text-left whitespace-nowrap">Date</th>
          <th class="p-4 text-left whitespace-nowrap">Time</th>
          <th class="p-4 text-left whitespace-nowrap">Doctor</th>
          <th class="p-4 text-left">Reason</th>
          <th class="p-4 text-left whitespace-nowrap">Status</th>
          <th class="p-4 text-left whitespace-nowrap">Action</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-100">
        <?php if (!empty($appointments)): ?>
          <?php foreach ($appointments as $a): ?>
            <?php
            $status = $a['status'] ?? '';
            $badge = 'bg-gray-200 text-gray-700';
            if ($status === 'scheduled') $badge = 'bg-blue-100 text-blue-700';
            if ($status === 'done') $badge = 'bg-green-100 text-green-700';
            if ($status === 'cancelled') $badge = 'bg-red-100 text-red-700';
            ?>

            <tr class="hover:bg-gray-50">
              <td class="p-4 whitespace-nowrap"><?= Security::e($a['date']) ?></td>
              <td class="p-4 whitespace-nowrap"><?= Security::e($a['time']) ?></td>

              <td class="p-4 font-medium whitespace-nowrap">
                <?= Security::e(($a['doctor_first'] ?? '') . ' ' . ($a['doctor_last'] ?? '')) ?>
              </td>

              <td class="p-4 text-gray-600">
                <?= Security::e($a['reason'] ?? '-') ?>
              </td>

              <td class="p-4 whitespace-nowrap">
                <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $badge ?>">
                  <?= Security::e($status) ?>
                </span>
              </td>

              <td class="p-4 whitespace-nowrap">
                <?php if ($status === 'scheduled'): ?>
                  <form method="POST" onsubmit="return confirm('Cancel this appointment?');">
                    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                    <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">

                    <button class="flex items-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-xs">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                      </svg>
                      Cancel
                    </button>
                  </form>
                <?php else: ?>
                  <span class="text-gray-400 text-sm">—</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="p-6 text-center text-gray-500">
              No appointments found.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>