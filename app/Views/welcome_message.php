<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tenant Track</title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      font-family: system-ui, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header{
      background: #148454;
    }
    .logo {
      width: 80px;
    }
    .hero {
      background-image: url(<?= base_url('assets/img/home-banner.jpg') ?>);
        background-size: cover;
        background-repeat: no-repeat;
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 2rem 1rem;
    }
    .hero-inner{
        background: #fffffff2;
        padding: 15px;
        border-radius: 10px;
    }
    .hero h1 {
      font-weight: 700;
      font-size: 1.75rem;
    }
    .btn-rounded {
      border-radius: 999px;
      padding: 0.75rem 2.5rem;
      font-size: 1rem;
      font-weight: 500;
    }
    @media (max-width: 767.98px) {
    .hero {
      background-image: url('<?= base_url('assets/img/home-banner-mobile.jpg') ?>');
      background-size: cover;
    }
  }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<header class="d-flex justify-content-between align-items-center px-3 py-1 border-bottom">
  <img src="<?= base_url('assets/img/logo.png') ?>" alt="TenantTrack Logo" class="logo">
</header>

<!-- Hero Section -->
<main class="hero">
    <div class="hero-inner">
        <h1>Tenant Track</h1>
        <p class="mt-2">Welcome to Tenant Track<br>Your Rental Hub!</p>

        <div class="d-grid gap-3 mt-4 px-5">
            <a href="/login" class="btn btn-dark btn-rounded">Login</a>
            <a href="/register" class="btn btn-dark btn-rounded">Register</a>
        </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
