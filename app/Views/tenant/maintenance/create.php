<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Submit Maintenance Request</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div style="color: red;">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<?php if (isset($validation)): ?>
    <div style="color: red;">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('tenant/maintenance/store') ?>" class="bs-form" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="issue_type">Issue Type:</label>
        <select name="issue_type" class="form-control" id="issue_type" required>
            <option value="">-- Select Issue --</option>
            <option value="Plumbing">Plumbing</option>
            <option value="Electrical">Electrical</option>
            <option value="Heating">Heating</option>
            <option value="Appliance">Appliance</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
    </div>

    <div class="form-group">
        <label for="issueImage">Upload Image (optional):</label><br>
        <input type="file" class="form-control-file" id="issueImage" name="image">
    </div>

    <div class="form-group">
        <a href="<?= base_url('tenant/maintenance') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Submit</button>
    </div>
</form>

<?= $this->endSection() ?>