<?php

use App\Core\Security;
use App\Core\CSRF; ?>
<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="max-w-md mx-auto mt-8">
  <div class="bg-white rounded-2xl shadow p-8 border border-gray-100">

    <!-- Title -->
    <div class="flex items-center gap-3 mb-6">
      <!-- Hospital icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-600" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 21h18M4 21V5a2 2 0 012-2h12a2 2 0 012 2v16M9 21V9h6v12M12 12v6M10 15h4" />
      </svg>

      <div>
        <h1 class="text-2xl font-bold text-gray-800">Login</h1>
        <p class="text-sm text-gray-500">Access your backoffice account</p>
      </div>
    </div>

    <!-- Flash message -->
    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
        <?= Security::e($_SESSION['flash']); ?>
      </div>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST" action="login.php" class="space-y-4">
      <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">

      <div>
        <label class="text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" placeholder="example@email.com" required
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                      focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>

      <div>
        <label class="text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" placeholder="********" required
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2
                      focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>

      <button class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
        <!-- Login icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
        </svg>
        Login
      </button>
    </form>

    <div class="mt-6 text-xs text-gray-500 text-center">
      Unity Care Clinic • Secure login (CSRF + Sessions)
    </div>

  </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>