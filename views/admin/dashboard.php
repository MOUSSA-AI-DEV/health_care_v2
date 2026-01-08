<?php use App\Core\Security; use App\Core\CSRF; ?>
<?php require VIEW_PATH.'/partials/header.php'; ?>

<h2>Admin Dashboard</h2>

<ul>
    <li><a href="<?= BASE_URL ?>/admin/statistics.php">Statistics</a></li>

  <li><a href="<?= BASE_URL ?>/admin/appointment.php">All appointments</a></li>
  <li><a href="<?= BASE_URL ?>/admin/medications.php">Manage medications</a></li>
  <li><a href="<?= BASE_URL ?>/admin/departments.php">Manage departments</a></li>
  <li><a href="<?= BASE_URL ?>/admin/users.php">Manage users</a></li>
</ul>

<form method="POST" action="<?= BASE_URL ?>/logout.php">
  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
  <button>Logout</button>
</form>

<?php require VIEW_PATH.'/partials/footer.php'; ?>
