<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Profile</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($validation->getErrors() as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('landlord/profile') ?>" method="post" class="bs-form">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" value="<?= esc($user['name']) ?>" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label>New Password (leave blank to keep current):</label>
        <input type="password" name="password" class="form-control">
    </div>
    
    <div class="form-group">
        <a href="<?= base_url('tenant') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Update Profile</button>
    </div>
</form>

<?= $this->endSection() ?>