<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex items-start justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <!-- Users icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-800" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 10-6 0 3 3 0 006 0z" />
      </svg>
      Manage Users
    </h1>
    <p class="text-sm text-gray-500 mt-1">Create doctors/patients and remove users.</p>
  </div>
</div>

<!-- Create user -->
<div class="bg-white rounded-xl shadow p-6 border border-gray-100 mb-6">
  <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-4">
    <!-- Plus icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4v16m8-8H4" />
    </svg>
    Create user
  </h2>

  <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
    <input type="hidden" name="action" value="create">

    <div>
      <label class="text-sm font-medium text-gray-700">First name</label>
      <input name="first_name" required placeholder="First name"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                    focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>

    <div>
      <label class="text-sm font-medium text-gray-700">Last name</label>
      <input name="last_name" required placeholder="Last name"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                    focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>

    <div>
      <label class="text-sm font-medium text-gray-700">Email</label>
      <input name="email" type="email" required placeholder="email@example.com"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                    focus:outline-none focus:ring-2 focus:ring-blue-200">
    </div>

    <div>
      <label class="text-sm font-medium text-gray-700">Password</label>
      <input name="password" required placeholder="Password"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                    focus:outline-none focus:ring-2 focus:ring-blue-200">
      <p class="text-xs text-gray-400 mt-1">Tip: use a strong password.</p>
    </div>

    <div class="md:col-span-2">
      <label class="text-sm font-medium text-gray-700">Role</label>
      <select name="role" required
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                     focus:outline-none focus:ring-2 focus:ring-blue-200">
        <option value="doctor">Doctor</option>
        <option value="patient">Patient</option>
      </select>
    </div>

    <div class="md:col-span-2 flex justify-end">
      <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
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

<!-- Doctors table -->
<div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden mb-6">
  <div class="p-5 border-b border-gray-100">
    <h2 class="font-semibold text-gray-800 flex items-center gap-2">
      <!-- Doctor icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5.121 17.804A9 9 0 1119 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
      Doctors
    </h2>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 text-gray-600">
        <tr>
          <th class="p-4 text-left whitespace-nowrap">ID</th>
          <th class="p-4 text-left">Name</th>
          <th class="p-4 text-left">Email</th>
          <th class="p-4 text-left whitespace-nowrap">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <?php if (!empty($doctors)): ?>
          <?php foreach ($doctors as $u): ?>
            <tr class="hover:bg-gray-50">
              <td class="p-4 font-semibold text-gray-700"><?= (int)$u['id'] ?></td>
              <td class="p-4 font-medium text-gray-800">
                <?= Security::e(($u['first_name'] ?? '') . ' ' . ($u['last_name'] ?? '')) ?>
              </td>
              <td class="p-4 text-gray-600"><?= Security::e($u['email'] ?? '') ?></td>
              <td class="p-4">
                <form method="POST" onsubmit="return confirm('Delete this user?');">
                  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                  <button class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition text-xs flex items-center gap-1">
                    <!-- Trash icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z" />
                    </svg>
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="p-6 text-center text-gray-500">No doctors found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Patients table -->
<div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
  <div class="p-5 border-b border-gray-100">
    <h2 class="font-semibold text-gray-800 flex items-center gap-2">
      <!-- Patient icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM6 21a6 6 0 0112 0" />
      </svg>
      Patients
    </h2>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 text-gray-600">
        <tr>
          <th class="p-4 text-left whitespace-nowrap">ID</th>
          <th class="p-4 text-left">Name</th>
          <th class="p-4 text-left">Email</th>
          <th class="p-4 text-left whitespace-nowrap">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <?php if (!empty($patients)): ?>
          <?php foreach ($patients as $u): ?>
            <tr class="hover:bg-gray-50">
              <td class="p-4 font-semibold text-gray-700"><?= (int)$u['id'] ?></td>
              <td class="p-4 font-medium text-gray-800">
                <?= Security::e(($u['first_name'] ?? '') . ' ' . ($u['last_name'] ?? '')) ?>
              </td>
              <td class="p-4 text-gray-600"><?= Security::e($u['email'] ?? '') ?></td>
              <td class="p-4">
                <form method="POST" onsubmit="return confirm('Delete this user?');">
                  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                  <button class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition text-xs flex items-center gap-1">
                    <!-- Trash icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z" />
                    </svg>
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="p-6 text-center text-gray-500">No patients found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>