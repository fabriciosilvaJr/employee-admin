<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <title>Funcionários</title>
</head>
<body>
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Funcionários</h2>
    <a href="<?= site_url('employees/create'); ?>" class="btn btn-primary">+ Novo</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Cargo</th><th>Salário</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($employees as $emp): ?>
        <tr>
          <td><?= $emp->id ?></td>
          <td><?= $emp->name ?></td>
          <td><?= $emp->email ?></td>
          <td><?= $emp->position ?></td>
          <td>$<?= number_format($emp->salary, 2) ?></td>
          <td>
            <a href="<?= site_url('employees/edit/'.$emp->id); ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="<?= site_url('employees/delete/'.$emp->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this employee?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
