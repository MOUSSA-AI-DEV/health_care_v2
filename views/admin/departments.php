<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="flex items-start justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <!-- Building icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-orange-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 21h18M5 21V7a2 2 0 012-2h10a2 2 0 012 2v14M9 21V9h6v12" />
      </svg>
      Departments
    </h1>
    <p class="text-sm text-gray-500 mt-1">Create, update, and remove clinic departments.</p>
  </div>
</div>

<!-- Add department -->
<div class="bg-white rounded-xl shadow p-6 border border-gray-100 mb-6">
  <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-4">
    <!-- Plus icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-600" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4v16m8-8H4" />
    </svg>
    Add Department
  </h2>

  <form method="POST" class="flex flex-col md:flex-row gap-3">
    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
    <input type="hidden" name="action" value="create">

    <input type="text" name="name" placeholder="Department name" required
      class="w-full md:flex-1 rounded-lg border border-gray-300 px-3 py-2
                  focus:outline-none focus:ring-2 focus:ring-orange-200">

    <button class="bg-orange-600 text-white px-5 py-2 rounded-lg hover:bg-orange-700 transition flex items-center gap-2">
      <!-- Check icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 13l4 4L19 7" />
      </svg>
      Add
    </button>
  </form>
</div>

<!-- Table -->
<div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-100 text-gray-600">
        <tr>
          <th class="p-4 text-left whitespace-nowrap">ID</th>
          <th class="p-4 text-left">Name</th>
          <th class="p-4 text-left whitespace-nowrap">Actions</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-100">
        <?php if (!empty($departments)): ?>
          <?php foreach ($departments as $d): ?>
            <tr class="hover:bg-gray-50">
              <td class="p-4 font-semibold text-gray-700"><?= (int)$d['id'] ?></td>
              <td class="p-4">
                <span class="font-medium text-gray-800"><?= Security::e($d['name']) ?></span>
              </td>

              <td class="p-4">
                <div class="flex flex-col md:flex-row gap-2">

                  <!-- Update -->
                  <form method="POST" class="flex items-center gap-2">
                    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= (int)$d['id'] ?>">

                    <input type="text" name="name" value="<?= Security::e($d['name']) ?>" required
                      class="w-full md:w-56 rounded-lg border border-gray-300 px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-blue-200">

                    <button class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition text-sm flex items-center gap-1">
                      <!-- Pencil icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5h2m2 2l-9 9-4 1 1-4 9-9a2 2 0 012.828 0l.172.172a2 2 0 010 2.828z" />
                      </svg>
                      Update
                    </button>
                  </form>

                  <!-- Delete -->
                  <form method="POST" onsubmit="return confirm('Delete this department?');">
                    <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= (int)$d['id'] ?>">

                    <button class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition text-sm flex items-center gap-1">
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
            <td colspan="3" class="p-6 text-center text-gray-500">No departments found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>