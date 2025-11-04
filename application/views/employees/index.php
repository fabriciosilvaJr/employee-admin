<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gerenciamento de Funcionários</title>
  <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <script src="<?= base_url('assets/js/jquery-3.7.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Employee Admin</a>
      <div class="d-flex">
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm">Sair</a>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Gerenciamento de Funcionários</h2>
      <button class="btn btn-primary" id="btnAdd">+ Adicionar Funcionário</button>
    </div>

    <table class="table table-striped table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Cargo</th>
          <th>Salário (R$)</th>
          <th>Admissão</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($employees)) : ?>
          <?php foreach ($employees as $emp): ?>
          <tr data-id="<?= $emp->id; ?>">
            <td><?= $emp->id; ?></td>
            <td><?= $emp->name; ?></td>
            <td><?= $emp->email; ?></td>
            <td><?= $emp->position; ?></td>
            <td><?= number_format($emp->salary, 2, ',', '.'); ?></td>
            <td><?= $emp->admission_date; ?></td>
            <td>
              <button class="btn btn-warning btn-sm editBtn">Editar</button>
              <button class="btn btn-danger btn-sm deleteBtn">Excluir</button>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-muted">Nenhum funcionário encontrado.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal de cadastro/edição -->
  <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="employeeForm">
          <div class="modal-header">
            <h5 class="modal-title" id="employeeModalLabel">Novo Funcionário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Cargo</label>
              <input type="text" name="position" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Salário (R$)</label>
              <input type="number" name="salary" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Data de Admissão</label>
              <input type="date" name="admission_date" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
  $(document).ready(function(){

    const API_URL = '<?= base_url("api/employees"); ?>';
    const modal = new bootstrap.Modal(document.getElementById('employeeModal'));

    $('#btnAdd').click(() => {
      $('#employeeForm')[0].reset();
      $('#id').val('');
      $('.modal-title').text('Novo Funcionário');
      modal.show();
    });

  

  });
  </script>
</body>
</html>
