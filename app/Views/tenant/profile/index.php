<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Profile</h2>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<form action="<?= base_url('tenant/profile/update') ?>" method="post" class="bs-form">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" value="<?= esc($user['name']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>New Password (Optional):</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <a href="<?= base_url('tenant') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Update</button>
    </div>
</form>

<?php if (session()->getFlashdata('validation')): ?>
    <div style="color:red">
        <?= session()->getFlashdata('validation')->listErrors() ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>