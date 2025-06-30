<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1>Welcome, <?= esc($name) ?>!</h1>
<p>Your role: <?= esc($role) ?></p>

<?php if ($role === 'tenant'): ?>
  <a href="<?= base_url('tenant') ?>">Tenant Area</a>
<?php elseif ($role === 'landlord'): ?>
  <a href="<?= base_url('landlord') ?>">Landlord Area</a>
<?php elseif ($role === 'admin'): ?>
  <a href="<?= base_url('admin') ?>">Admin Area</a>
<?php endif; ?>

<br><a href="<?= base_url('logout') ?>">Logout</a>



<?= $this->endSection() ?>