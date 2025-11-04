<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
   
<link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/css/sign-in.css'); ?>" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <main class="form-signin w-100 m-auto">
    <form method="post" action="<?php echo site_url('auth/login'); ?>">
      <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>

      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger text-center"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2025</p>
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
