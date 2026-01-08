<?php use App\Core\Security; use App\Core\CSRF; ?>
<?php require VIEW_PATH.'/partials/header.php'; ?>

<h2>Departments</h2>

<form method="POST">
  <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
  <input type="hidden" name="action" value="create">
  <input type="text" name="name" placeholder="Department name" required>
  <button>Add</button>
</form>

<hr>

<table border="1" cellpadding="6">
  <tr><th>ID</th><th>Name</th><th>Actions</th></tr>
  <?php foreach ($departments as $d): ?>
    <tr>
      <td><?= (int)$d['id'] ?></td>
      <td><?= Security::e($d['name']) ?></td>
      <td>
        <form method="POST" style="display:inline;">
          <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= (int)$d['id'] ?>">
          <input type="text" name="name" value="<?= Security::e($d['name']) ?>" required>
          <button>Update</button>
        </form>

        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
          <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" value="<?= (int)$d['id'] ?>">
          <button>Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require VIEW_PATH.'/partials/footer.php'; ?>
