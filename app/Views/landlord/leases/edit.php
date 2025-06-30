<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Lease</h2>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red"><?= session()->getFlashdata('error') ?></p>
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

<form action="<?= base_url('landlord/leases/update/' . $lease['id']) ?>" class="bs-form" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Tenant:</label>
        <select name="tenant_id" class="form-control">
            <?php foreach ($tenants as $tenant): ?>
                <option value="<?= $tenant['id'] ?>" <?= $lease['tenant_id'] == $tenant['id'] ? 'selected' : '' ?>>
                    <?= esc($tenant['name']) ?> (<?= esc($tenant['email']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Property:</label>
        <select name="property_id" class="form-control">
            <?php foreach ($properties as $property): ?>
                <option value="<?= $property['id'] ?>" <?= $lease['property_id'] == $property['id'] ? 'selected' : '' ?>>
                    <?= esc($property['address']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Start Date:</label>
        <input type="date" name="start_date" class="form-control" value="<?= esc($lease['start_date']) ?>">
    </div>
    
    <div class="form-group">
        <label>End Date:</label>
        <input type="date" name="end_date" class="form-control" value="<?= esc($lease['end_date']) ?>">
    </div>
    
    <div class="form-group">
        <label>Monthly Rent:</label>
        <input type="text" name="monthly_rent" class="form-control" value="<?= esc($lease['monthly_rent']) ?>">
    </div>
    
    <div class="form-group">
        <label>Upload Lease File (PDF):</label><br>
        <input type="file" name="agreement_file" accept="application/pdf"><br>
        <?php if ($lease['agreement_file']): ?>
            <a href="<?= base_url('uploads/leases/' . $lease['agreement_file']) ?>" target="_blank">Current File</a>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <a href="<?= base_url('landlord/leases') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Update Lease</button>
    </div>
</form>

<?= $this->endSection() ?>