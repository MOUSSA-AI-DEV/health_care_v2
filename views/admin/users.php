<?php use App\Core\Security; use App\Core\CSRF; ?>
<?php require VIEW_PATH.'/partials/header.php'; ?>

<h2>Users</h2>

<h3>Create user</h3>
<form method="POST">
  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
  <input type="hidden" name="action" value="create">

  <input name="first_name" placeholder="First name" required>
  <input name="last_name" placeholder="Last name" required>
  <input name="email" type="email" placeholder="Email" required>
  <input name="password" placeholder="Password" required>

  <select name="role" required>
    <option value="doctor">Doctor</option>
    <option value="patient">Patient</option>
  </select>

  <button>Create</button>
</form>

<hr>

<h3>Doctors</h3>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
<?php foreach ($doctors as $u): ?>
<tr>
  <td><?= (int)$u['id'] ?></td>
  <td><?= Security::e(($u['first_name'] ?? '').' '.($u['last_name'] ?? '')) ?></td>
  <td><?= Security::e($u['email'] ?? '') ?></td>
  <td>
    <form method="POST" onsubmit="return confirm('Delete?');">
      <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
      <button>Delete</button>
    </form>
  </td>
</tr>
<?php endforeach; ?>
</table>

<h3>Patients</h3>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
<?php foreach ($patients as $u): ?>
<tr>
  <td><?= (int)$u['id'] ?></td>
  <td><?= Security::e(($u['first_name'] ?? '').' '.($u['last_name'] ?? '')) ?></td>
  <td><?= Security::e($u['email'] ?? '') ?></td>
  <td>
    <form method="POST" onsubmit="return confirm('Delete?');">
      <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
      <button>Delete</button>
    </form>
  </td>
</tr>
<?php endforeach; ?>
</table>

<?php require VIEW_PATH.'/partials/footer.php'; ?>
