<?php use App\Core\Security; ?>
<?php require VIEW_PATH.'/partials/header.php'; ?>

<h2>Admin Statistics</h2>

<h3>Appointments by status</h3>
<table border="1" cellpadding="6">
  <tr><th>Status</th><th>Total</th></tr>
  <?php foreach ($byStatus as $r): ?>
    <tr>
      <td><?= Security::e($r['status']) ?></td>
      <td><?= (int)$r['total'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<hr>

<h3>Appointments by doctor</h3>
<table border="1" cellpadding="6">
  <tr><th>Doctor</th><th>Total</th></tr>
  <?php foreach ($byDoctor as $r): ?>
    <tr>
      <td><?= Security::e($r['doctor_name']) ?></td>
      <td><?= (int)$r['total'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<hr>

<h3>Monthly appointments</h3>
<table border="1" cellpadding="6">
  <tr><th>Month</th><th>Total</th></tr>
  <?php foreach ($monthly as $r): ?>
    <tr>
      <td><?= Security::e($r['month']) ?></td>
      <td><?= (int)$r['total'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<hr>

<h3>Top prescribed medications</h3>
<table border="1" cellpadding="6">
  <tr><th>Medication</th><th>Total</th></tr>
  <?php foreach ($topMeds as $r): ?>
    <tr>
      <td><?= Security::e($r['medication_name']) ?></td>
      <td><?= (int)$r['total'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require VIEW_PATH.'/partials/footer.php'; ?>
