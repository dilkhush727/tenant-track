<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Create Lease Agreement</h2>

<?php
    $validation = \Config\Services::validation();
    if (session()->has('validation')) {
        $validation = session('validation');
    }
?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (isset($validation) && $validation->getErrors()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($validation->getErrors() as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('landlord/leases/store') ?>" method="post" class="bs-form" enctype="multipart/form-data">
    <div class="form-group">
        <label>Tenant:</label>
        <select name="tenant_id" class="form-control" required>
            <option value="">-- Select Tenant --</option>
            <?php foreach ($tenants as $tenant): ?>
                <option value="<?= $tenant['id'] ?>" <?= old('tenant_id') == $tenant['id'] ? 'selected' : '' ?>>
                    <?= esc($tenant['name']) ?> (<?= esc($tenant['email']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Property:</label>
        <select name="property_id" class="form-control" required>
            <option value="">-- Select Property --</option>
            <?php foreach ($properties as $property): ?>
                <option value="<?= $property['id'] ?>" <?= old('property_id') == $property['id'] ? 'selected' : '' ?>>
                    <?= esc($property['address']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Start Date:</label>
        <input type="date" name="start_date" class="form-control" required value="<?= old('start_date') ?>">
    </div>
    
    <div class="form-group">
        <label>End Date:</label>
        <input type="date" name="end_date" class="form-control" required value="<?= old('end_date') ?>">
    </div>
    
    <div class="form-group">
        <label>Monthly Rent:</label>
        <input type="text" name="monthly_rent" class="form-control" required value="<?= old('monthly_rent') ?>">
        <small class="text-muted">Enter numbers only (no symbols)</small>
    </div>
    
    <div class="form-group">
        <label>Upload Lease File (PDF only):</label><br>
        <input type="file" name="agreement_file" accept="application/pdf">
    </div>
    
    <div class="form-group">
        <a href="<?= base_url('landlord/leases') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Save Lease</button>
    </div>
</form>

<?= $this->endSection() ?>