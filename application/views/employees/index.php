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

  <!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteLabel">Confirmar exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir <strong id="deleteEmployeeName">este funcionário</strong>?
        <input type="hidden" id="deleteEmployeeId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
          <span class="spinner-border spinner-border-sm d-none" id="deleteSpinner" role="status" aria-hidden="true"></span>
          <span id="deleteBtnText">Excluir</span>
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    const API_URL = '<?= base_url("api/employees"); ?>';
    const modal = new bootstrap.Modal(document.getElementById('employeeModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));

    const $deleteName = $('#deleteEmployeeName');
    const $deleteId = $('#deleteEmployeeId');
    const $confirmBtn = $('#confirmDeleteBtn');
    const $spinner = $('#deleteSpinner');
    const $btnText = $('#deleteBtnText');

    $('#btnAdd').click(() => {
      $('#employeeForm')[0].reset();
      $('#id').val('');
      $('.modal-title').text('Novo Funcionário');
      modal.show();
    });

    $('#employeeForm').on('submit', function(e) {
      e.preventDefault();

      const id = $('#id').val();
      const url = id ? `${API_URL}/update/${id}` : `${API_URL}/create`;

      $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: () => $('.modal-title').text('Salvando...'),
        success: function(res) {
          alert(res.message);
          if (res.status === 'success') {
            modal.hide();
            setTimeout(() => location.reload(), 500);
          }
        },
        error: function() {
          alert('Erro ao enviar requisição.');
        }
      });
    });

    $('.editBtn').click(function() {
      const tr = $(this).closest('tr');
      $('#id').val(tr.data('id'));
      $('#employeeForm [name="name"]').val(tr.find('td:eq(1)').text());
      $('#employeeForm [name="email"]').val(tr.find('td:eq(2)').text());
      $('#employeeForm [name="position"]').val(tr.find('td:eq(3)').text());
      $('#employeeForm [name="salary"]').val(tr.find('td:eq(4)').text().replace('.', '').replace(',', '.'));
      $('#employeeForm [name="admission_date"]').val(tr.find('td:eq(5)').text());
      $('.modal-title').text('Editar Funcionário');
      modal.show();
    });

    $('.deleteBtn').click(function() {
      const tr = $(this).closest('tr');
      const id = tr.data('id');
      const name = tr.find('td:eq(1)').text().trim();

      $deleteId.val(id);
      $deleteName.text(name || 'este funcionário');
      deleteModal.show();
    });

    $confirmBtn.on('click', function() {
      const id = $deleteId.val();
      if (!id) return;

      $confirmBtn.prop('disabled', true);
      $spinner.removeClass('d-none');
      $btnText.text('Excluindo...');

      $.ajax({
        url: `${API_URL}/delete/${id}`,
        type: 'DELETE',
        dataType: 'json',
        success: function(res) {
          if (res.status === 'success') {
            deleteModal.hide();
            alert(res.message);
            setTimeout(() => location.reload(), 500);
          } else {
            alert(res.message || 'Erro ao excluir.');
          }
        },
        error: function() {
          alert('Erro ao tentar excluir o funcionário.');
        },
        complete: function() {
          $confirmBtn.prop('disabled', false);
          $spinner.addClass('d-none');
          $btnText.text('Excluir');
        }
      });
    });

  });
</script>

</body>
</html>
