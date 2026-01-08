<?php use App\Core\Security; use App\Core\CSRF; ?>
<?php require VIEW_PATH.'/partials/header.php'; ?>

<h2>Manage Medications</h2>

<h3>Add medication</h3>
<form method="POST">
  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
  <input type="hidden" name="action" value="create">

  <label>Name</label><br>
  <input type="text" name="name" required><br><br>

  <label>Description</label><br>
  <textarea name="description"></textarea><br><br>

  <button type="submit">Add</button>
</form>

<hr>

<h3>List</h3>
<table border="1" cellpadding="6">
  <tr>
    <th>ID</th><th>Name</th><th>Description</th><th>Actions</th>
  </tr>

  <?php foreach ($meds as $m): ?>
    <tr>
      <td><?= (int)$m['id'] ?></td>
      <td><?= Security::e($m['name']) ?></td>
      <td><?= Security::e($m['description'] ?? '') ?></td>
      <td>
        <!-- UPDATE -->
        <form method="POST" style="display:inline;">
          <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">

          <input type="text" name="name" value="<?= Security::e($m['name']) ?>" required>
          <input type="text" name="description" value="<?= Security::e($m['description'] ?? '') ?>">

          <button type="submit">Update</button>
        </form>

        <!-- DELETE -->
        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
          <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
          <button type="submit">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require VIEW_PATH.'/partials/footer.php'; ?>
