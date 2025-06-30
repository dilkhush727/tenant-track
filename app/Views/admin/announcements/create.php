<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Create Announcement</h2>

<?php if (isset($validation)): ?>
    <div style="color:red">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= base_url('admin/announcements/store') ?>" class="bs-form">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" value="<?= old('title') ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Message</label>
        <textarea name="message" class="form-control" required><?= old('message') ?></textarea>
    </div>

    <div class="form-group">
        <label>Target Role</label>
        <select name="target_role" class="form-control">
            <option value="all">All</option>
            <option value="tenant">Tenants Only</option>
            <option value="landlord">Landlords Only</option>
        </select>
    </div>

    <div class="form-group">
        <a href="<?= base_url('landlord/leases') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Post Announcement</button>
    </div>
</form>

<?= $this->endSection() ?>