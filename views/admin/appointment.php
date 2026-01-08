<?php use App\Core\Security; use App\Core\CSRF; ?>
<?php require VIEW_PATH.'/partials/header.php'; ?>

<h2>All Appointments (Admin)</h2>

<table border="1" cellpadding="6">
  <tr>
    <th>Date</th><th>Time</th><th>Doctor</th><th>Patient</th><th>Reason</th><th>Status</th><th>Action</th>
  </tr>

  <?php foreach ($appointments as $a): ?>
    <tr>
      <td><?= Security::e($a['date']) ?></td>
      <td><?= Security::e($a['time']) ?></td>
      <td><?= Security::e(($a['doctor_first'] ?? '').' '.($a['doctor_last'] ?? '')) ?></td>
      <td><?= Security::e(($a['patient_first'] ?? '').' '.($a['patient_last'] ?? '')) ?></td>
      <td><?= Security::e($a['reason'] ?? '') ?></td>
      <td><?= Security::e($a['status']) ?></td>
      <td>
        <?php if (($a['status'] ?? '') === 'scheduled'): ?>
          <form method="POST">
            <input type="hidden" name="_csrf" value="<?= Security::e(CSRF::token()); ?>">
            <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
            <button type="submit">Cancel</button>
          </form>
        <?php else: ?>
          -
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require VIEW_PATH.'/partials/footer.php'; ?>
