<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gerenciamento de Funcionários</title>

  <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <script src="<?= base_url('assets/js/jquery-3.7.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }

    h2 {
      font-weight: 600;
      color: #212529;
    }

    /* Deixa a tabela responsiva com rolagem */
    .table-responsive {
      border-radius: .5rem;
      overflow-x: auto;
    }

    /* Ajuste visual dos botões em telas pequenas */
    @media (max-width: 576px) {
      .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
      }

      h2 {
        font-size: 1.3rem;
      }

      #btnAdd {
        font-size: 0.9rem;
        padding: 0.4rem 0.8rem;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid px-3">
      <a class="navbar-brand fw-bold" href="#">Employee Admin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm mt-2 mt-lg-0">Sair</a>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
      <h2 class="m-0">Gerenciamento de Funcionários</h2>
      <button class="btn btn-primary" id="btnAdd">+ Adicionar Funcionário</button>
    </div>

    <div class="table-responsive shadow-sm">
      <table class="table table-striped table-bordered text-center align-middle mb-0">
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
                  <div class="btn-group">
                    <button class="btn btn-warning btn-sm editBtn">Editar</button>
                    <button class="btn btn-danger btn-sm deleteBtn">Excluir</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="7" class="text-muted py-4">Nenhum funcionário encontrado.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Funcionário -->
  <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <form id="employeeForm">
          <input type="hidden" name="id" id="id">

          <div class="modal-header">
            <h5 class="modal-title" id="employeeModalLabel">Novo Funcionário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Cargo</label>
                <input type="text" name="position" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Salário (R$)</label>
                <input type="number" name="salary" step="0.01" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Data de Admissão</label>
                <input type="date" name="admission_date" class="form-control" required>
              </div>
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

  <!-- Modal de Exclusão -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteLabel">Confirmar exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir <strong id="deleteEmployeeName">este funcionário</strong>?
          <input type="hidden" id="deleteEmployeeId">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
            <span class="spinner-border spinner-border-sm d-none" id="deleteSpinner"></span>
            <span id="deleteBtnText">Excluir</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastMessage" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body fw-semibold"></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function() {

    const API_URL = '<?= base_url("api/employees"); ?>';
    const modal = new bootstrap.Modal(document.getElementById('employeeModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const toastEl = document.getElementById('toastMessage');
    const toast = new bootstrap.Toast(toastEl);

    const showToast = (msg, type = 'primary') => {
      const $toast = $('#toastMessage');
      $toast.removeClass('text-bg-primary text-bg-success text-bg-danger');
      $toast.addClass(`text-bg-${type}`);
      $toast.find('.toast-body').text(msg);
      toast.show();
    };

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
          showToast(res.message, res.status === 'success' ? 'success' : 'danger');
          if (res.status === 'success') {
            modal.hide();
            setTimeout(() => location.reload(), 1500);
          }
        },
        error: function() {
          showToast('Erro ao enviar requisição.', 'danger');
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

      $('#deleteEmployeeId').val(id);
      $('#deleteEmployeeName').text(name || 'este funcionário');
      deleteModal.show();
    });

    $('#confirmDeleteBtn').on('click', function() {
      const id = $('#deleteEmployeeId').val();
      if (!id) return;

      const btn = $(this);
      const spinner = $('#deleteSpinner');
      const btnText = $('#deleteBtnText');

      btn.prop('disabled', true);
      spinner.removeClass('d-none');
      btnText.text('Excluindo...');

      $.ajax({
        url: `${API_URL}/delete/${id}`,
        type: 'DELETE',
        dataType: 'json',
        success: function(res) {
          showToast(res.message, res.status === 'success' ? 'success' : 'danger');
          if (res.status === 'success') {
            deleteModal.hide();
            setTimeout(() => location.reload(), 1500);
          }
        },
        error: function() {
          showToast('Erro ao tentar excluir o funcionário.', 'danger');
        },
        complete: function() {
          btn.prop('disabled', false);
          spinner.addClass('d-none');
          btnText.text('Excluir');
        }
      });
    });

  });
</script>


</body>
</html>
