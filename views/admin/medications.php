<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex items-start justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <!-- Pill icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 14l-2 2m0 0l-2-2m2 2V8m11 6a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      Manage Medications
    </h1>
    <p class="text-sm text-gray-500 mt-1">Create, update, and delete medications.</p>
  </div>
</div>

<!-- Add medication -->
<div class="bg-white rounded-xl shadow p-6 border border-gray-100 mb-6">
  <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-4">
    <!-- Plus icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4v16m8-8H4" />
    </svg>
    Add medication
  </h2>

  <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
    <input type="hidden" name="action" value="create">

    <div class="md:col-span-1">
      <label class="text-sm font-medium text-gray-700">Name</label>
      <input type="text" name="name" required
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                    focus:outline-none focus:ring-2 focus:ring-green-200">
    </div>

    <div class="md:col-span-2">
      <label class="text-sm font-medium text-gray-700">Description</label>
      <textarea name="description" rows="3"
        class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-green-200"
        placeholder="Optional description..."></textarea>
    </div>

    <div class="md:col-span-2 flex justify-end">
      <button type="submit"
        class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <!-- Check icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 13l4 4L19 7" />
        </svg>
        Add
      </button>
    </div>
  </form>
</div>

<!-- List -->
<div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-100 text-gray-600">
        <tr>
          <th class="p-4 text-left whitespace-nowrap">ID</th>
          <th class="p-4 text-left whitespace-nowrap">Name</th>
          <th class="p-4 text-left">Description</th>
          <th class="p-4 text-left whitespace-nowrap">Actions</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-100">
        <?php if (!empty($meds)): ?>
          <?php foreach ($meds as $m): ?>
            <tr class="hover:bg-gray-50">
              <td class="p-4 font-semibold text-gray-700"><?= (int)$m['id'] ?></td>

              <td class="p-4 font-medium text-gray-800">
                <?= Security::e($m['name']) ?>
              </td>

              <td class="p-4 text-gray-600">
                <?= Security::e($m['description'] ?? '') ?>
              </td>

              <td class="p-4">
                <div class="flex flex-col lg:flex-row gap-2">

                  <!-- UPDATE -->
                  <form method="POST" class="flex flex-col md:flex-row items-stretch md:items-center gap-2">
                    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">

                    <input type="text" name="name" value="<?= Security::e($m['name']) ?>" required
                      class="w-full md:w-44 rounded-lg border border-gray-300 px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-blue-200">

                    <input type="text" name="description" value="<?= Security::e($m['description'] ?? '') ?>"
                      class="w-full md:w-64 rounded-lg border border-gray-300 px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-blue-200"
                      placeholder="Description">

                    <button type="submit"
                      class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition text-sm flex items-center justify-center gap-1">
                      <!-- Pencil icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5h2m2 2l-9 9-4 1 1-4 9-9a2 2 0 012.828 0l.172.172a2 2 0 010 2.828z" />
                      </svg>
                      Update
                    </button>
                  </form>

                  <!-- DELETE -->
                  <form method="POST" onsubmit="return confirm('Delete this medication?');">
                    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">

                    <button type="submit"
                      class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition text-sm flex items-center justify-center gap-1">
                      <!-- Trash icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z" />
                      </svg>
                      Delete
                    </button>
                  </form>

                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="p-6 text-center text-gray-500">
              No medications found.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>