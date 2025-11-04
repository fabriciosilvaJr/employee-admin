<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel de Controle</title>
  <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card:hover {
      transform: translateY(-3px);
      transition: 0.3s ease-in-out;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="<?= site_url('dashboard'); ?>">Employee Admin</a>
      <div class="d-flex">
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm">Sair</a>
      </div>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <div class="container py-5">
    <div class="text-center mb-5">
      <h1 class="mb-3">Bem-vindo, <?= isset($user->name) ? $user->name : 'Usuário'; ?> 👋</h1>
      <p class="lead text-muted">Gerencie os funcionários da empresa e acompanhe as informações principais.</p>
      <hr class="w-25 mx-auto mb-5">
    </div>

    <div class="row justify-content-center g-4">
      <!-- Card Funcionários -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body text-center">
            <h5 class="card-title mb-3">Funcionários</h5>
            <p class="card-text text-muted">Visualize, adicione, edite e exclua os funcionários cadastrados.</p>
            <a href="<?= site_url('employees'); ?>" class="btn btn-primary w-100">Gerenciar Funcionários</a>
          </div>
        </div>
      </div>

   
    </div>
  </div>

  <footer class="text-center py-4 text-muted small">
    &copy; <?= date('Y'); ?> Employee Admin · Todos os direitos reservados.
  </footer>

  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
