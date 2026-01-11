<?php

use App\Core\Security; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex items-start justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <!-- Chart icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 3v18m4-14v14m4-10v10M7 13v8M3 17v4" />
      </svg>
      Doctor Statistics
    </h1>
    <p class="text-sm text-gray-500 mt-1">
      Overview of your appointments and prescriptions.
    </p>
  </div>
</div>

<!-- Quick cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <?php
  $scheduled = 0;
  $done = 0;
  $cancelled = 0;
  $total = 0;
  foreach ($byStatus as $r) {
    $s = $r['status'] ?? '';
    $t = (int)($r['total'] ?? 0);
    $total += $t;
    if ($s === 'scheduled') $scheduled = $t;
    if ($s === 'done') $done = $t;
    if ($s === 'cancelled') $cancelled = $t;
  }
  ?>

  <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <div class="text-gray-500 text-sm">Total appointments</div>
    <div class="text-3xl font-bold text-gray-800 mt-1"><?= (int)$total ?></div>
  </div>

  <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-gray-500 text-sm">Scheduled</div>
      <!-- Clock icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <div class="text-3xl font-bold text-blue-700 mt-1"><?= (int)$scheduled ?></div>
  </div>

  <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <div class="flex items-center justify-between">
      <div class="text-gray-500 text-sm">Done</div>
      <!-- Check icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 13l4 4L19 7" />
      </svg>
    </div>
    <div class="text-3xl font-bold text-green-700 mt-1"><?= (int)$done ?></div>
  </div>
</div>

<!-- Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

  <!-- By Status -->
  <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
    <div class="p-5 border-b flex items-center gap-2">
      <!-- Badge icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12h6m2 9H7a2 2 0 01-2-2V5a2 2 0 012-2h6l4 4v14a2 2 0 01-2 2z" />
      </svg>
      <h2 class="text-lg font-semibold text-gray-800">Appointments by status</h2>
    </div>

    <table class="w-full text-sm">
      <thead class="bg-gray-100 text-gray-600">
        <tr>
          <th class="p-4 text-left">Status</th>
          <th class="p-4 text-left">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($byStatus as $r): ?>
          <?php
          $status = $r['status'] ?? '';
          $badge = 'bg-gray-200 text-gray-700';
          if ($status === 'scheduled') $badge = 'bg-blue-100 text-blue-700';
          if ($status === 'done') $badge = 'bg-green-100 text-green-700';
          if ($status === 'cancelled') $badge = 'bg-red-100 text-red-700';
          ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="p-4">
              <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $badge ?>">
                <?= Security::e($status) ?>
              </span>
            </td>
            <td class="p-4 font-semibold"><?= (int)$r['total'] ?></td>
          </tr>
        <?php endforeach; ?>

        <?php if (empty($byStatus)): ?>
          <tr>
            <td colspan="2" class="p-6 text-center text-gray-500">No data</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Top meds -->
  <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
    <div class="p-5 border-b flex items-center gap-2">
      <!-- Pill icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 14l-2 2m0 0l-2-2m2 2V8m11 6a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <h2 class="text-lg font-semibold text-gray-800">Top prescribed medications</h2>
    </div>

    <table class="w-full text-sm">
      <thead class="bg-gray-100 text-gray-600">
        <tr>
          <th class="p-4 text-left">Medication</th>
          <th class="p-4 text-left">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($topMeds as $r): ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="p-4 font-medium"><?= Security::e($r['medication_name']) ?></td>
            <td class="p-4 font-semibold"><?= (int)$r['total'] ?></td>
          </tr>
        <?php endforeach; ?>

        <?php if (empty($topMeds)): ?>
          <tr>
            <td colspan="2" class="p-6 text-center text-gray-500">No data</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>