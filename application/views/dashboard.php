<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Employee Admin</a>
      <div class="d-flex">
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="text-center">
      <h1 class="mb-4">Welcome, <?= isset($user->name) ? $user->name : 'User'; ?> 👋</h1>
      <p class="lead text-muted">You have successfully logged in to the dashboard.</p>

      <div class="card mt-4 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Next Step</h5>
          <p class="card-text">Here you’ll be able to manage employees (CRUD) and user sessions.</p>
          <a href="#" class="btn btn-primary disabled">Feature coming soon...</a>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
