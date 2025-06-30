<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Record Payment</h2>

<!-- Show flash error message if present -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Show validation errors -->
<?php if (session('validation')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('validation')->getErrors() as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('landlord/payments/store') ?>" class="bs-form" method="post">
    <!-- Tenant -->
    <div class="form-group">
        <label>Tenant:</label>
        <select name="tenant_id" id="tenant-select" class="form-control" required>
            <option value="">-- Select Tenant --</option>
            <?php foreach ($tenants as $tenant): ?>
                <option value="<?= $tenant['id'] ?>" <?= old('tenant_id') == $tenant['id'] ? 'selected' : '' ?>>
                    <?= esc($tenant['name']) ?> (<?= esc($tenant['email']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Lease -->
    <div class="form-group">
        <label>Lease:</label>
        <select name="lease_id" id="lease-select" class="form-control" required>
            <option value="">-- Select Lease --</option>
            <?php foreach ($leases as $lease): ?>
                <option value="<?= $lease['id'] ?>" data-tenant="<?= $lease['tenant_id'] ?>" <?= old('lease_id') == $lease['id'] ? 'selected' : '' ?>>
                    Lease #<?= $lease['id'] ?> | Property <?= $lease['property_id'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Amount:</label>
        <input type="text" name="amount" class="form-control" required value="<?= old('amount') ?>">
    </div>
    
    <div class="form-group">
        <label>Date Paid:</label>
        <input type="date" name="date_paid" class="form-control" required value="<?= old('date_paid') ?>">
    </div>
    
    <div class="form-group">
        <label>Method:</label>
        <input type="text" name="method" class="form-control" required value="<?= old('method') ?>">
    </div>
    
    <div class="form-group">
        <label>Status:</label>
        <select name="status" class="form-control" required>
            <option value="">-- Select Status --</option>
            <option value="paid" <?= old('status') == 'paid' ? 'selected' : '' ?>>Paid</option>
            <option value="pending" <?= old('status') == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="failed" <?= old('status') == 'failed' ? 'selected' : '' ?>>Failed</option>
        </select>
    </div>
    
    <div class="form-group">
        <a href="<?= base_url('landlord/payments') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Submit</button>
    </div>
</form>

<script>
document.getElementById('tenant-select').addEventListener('change', function () {
    const tenantId = this.value;
    const leaseOptions = document.querySelectorAll('#lease-select option');

    leaseOptions.forEach(option => {
        if (!option.value) return;
        option.style.display = option.dataset.tenant === tenantId ? 'block' : 'none';
    });

    document.getElementById('lease-select').value = '';
});
</script>

<?= $this->endSection() ?>