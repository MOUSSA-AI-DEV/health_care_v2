<?php

use App\Core\Security; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="mb-8">
  <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
    <!-- Chart icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M11 3v18m4-14v14m4-10v10M7 13v8M3 17v4" />
    </svg>
    Admin Statistics
  </h1>
  <p class="text-sm text-gray-500 mt-1">
    Overview of appointments and prescriptions activity.
  </p>
</div>

<!-- Summary cards (simple totals) -->
<?php
$sumStatus = 0;
foreach (($byStatus ?? []) as $r) $sumStatus += (int)($r['total'] ?? 0);

$sumMonthly = 0;
foreach (($monthly ?? []) as $r) $sumMonthly += (int)($r['total'] ?? 0);

$topMedName = $topMeds[0]['medication_name'] ?? '-';
$topMedTotal = (int)($topMeds[0]['total'] ?? 0);
?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <!-- Total appointments -->
  <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-sm text-gray-500">Total appointments</div>
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
    </div>
    <div class="mt-2 text-3xl font-bold text-gray-800"><?= (int)$sumStatus ?></div>
    <div class="mt-1 text-xs text-gray-400">All statuses combined</div>
  </div>

  <!-- Monthly total (sum of months shown) -->
  <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-sm text-gray-500">Appointments (monthly view)</div>
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 3v18h18" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M7 14l4-4 4 4 5-6" />
      </svg>
    </div>
    <div class="mt-2 text-3xl font-bold text-gray-800"><?= (int)$sumMonthly ?></div>
    <div class="mt-1 text-xs text-gray-400">Sum of the months listed below</div>
  </div>

  <!-- Top medication -->
  <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-sm text-gray-500">Top prescribed medication</div>
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 14l-2 2m0 0l-2-2m2 2V8m11 6a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <div class="mt-2 text-lg font-bold text-gray-800"><?= Security::e($topMedName) ?></div>
    <div class="mt-1 text-sm text-gray-500"><?= (int)$topMedTotal ?> prescriptions</div>
  </div>
</div>

<!-- Tables grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

  <!-- Appointments by status -->
  <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
    <div class="p-5 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l4 4v14a2 2 0 01-2 2z" />
        </svg>
        Appointments by status
      </h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
          <tr>
            <th class="p-4 text-left">Status</th>
            <th class="p-4 text-left">Total</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php if (!empty($byStatus)): ?>
            <?php foreach ($byStatus as $r): ?>
              <?php
              $s = $r['status'] ?? '';
              $badge = 'bg-gray-200 text-gray-700';
              if ($s === 'scheduled') $badge = 'bg-blue-100 text-blue-700';
              if ($s === 'done') $badge = 'bg-green-100 text-green-700';
              if ($s === 'cancelled') $badge = 'bg-red-100 text-red-700';
              ?>
              <tr class="hover:bg-gray-50">
                <td class="p-4">
                  <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $badge ?>">
                    <?= Security::e($s) ?>
                  </span>
                </td>
                <td class="p-4 font-semibold text-gray-800"><?= (int)($r['total'] ?? 0) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2" class="p-6 text-center text-gray-500">No data</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Appointments by doctor -->
  <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
    <div class="p-5 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5.121 17.804A9 9 0 1119 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Appointments by doctor
      </h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
          <tr>
            <th class="p-4 text-left">Doctor</th>
            <th class="p-4 text-left">Total</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php if (!empty($byDoctor)): ?>
            <?php foreach ($byDoctor as $r): ?>
              <tr class="hover:bg-gray-50">
                <td class="p-4 font-medium text-gray-800"><?= Security::e($r['doctor_name'] ?? '-') ?></td>
                <td class="p-4 font-semibold text-gray-800"><?= (int)($r['total'] ?? 0) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2" class="p-6 text-center text-gray-500">No data</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Monthly appointments -->
  <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
    <div class="p-5 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Monthly appointments
      </h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
          <tr>
            <th class="p-4 text-left">Month</th>
            <th class="p-4 text-left">Total</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php if (!empty($monthly)): ?>
            <?php foreach ($monthly as $r): ?>
              <tr class="hover:bg-gray-50">
                <td class="p-4 font-medium text-gray-800"><?= Security::e($r['month'] ?? '-') ?></td>
                <td class="p-4 font-semibold text-gray-800"><?= (int)($r['total'] ?? 0) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2" class="p-6 text-center text-gray-500">No data</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Top meds -->
  <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
    <div class="p-5 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 14l-2 2m0 0l-2-2m2 2V8m11 6a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Top prescribed medications
      </h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
          <tr>
            <th class="p-4 text-left">Medication</th>
            <th class="p-4 text-left">Total</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php if (!empty($topMeds)): ?>
            <?php foreach ($topMeds as $r): ?>
              <tr class="hover:bg-gray-50">
                <td class="p-4 font-medium text-gray-800"><?= Security::e($r['medication_name'] ?? '-') ?></td>
                <td class="p-4 font-semibold text-gray-800"><?= (int)($r['total'] ?? 0) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2" class="p-6 text-center text-gray-500">No data</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>