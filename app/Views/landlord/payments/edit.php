<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Payment</h2>

<?php if (isset($validation)): ?>
    <div style="color:red">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('landlord/payments/update/' . $payment['id']) ?>" method="post" class="bs-form" enctype="multipart/form-data">
    <div class="form-group">
        <label>Amount:</label>
        <input type="text" name="amount" value="<?= esc($payment['amount']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Date Paid:</label>
        <input type="date" name="date_paid" value="<?= esc($payment['date_paid']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Method:</label>
        <input type="text" name="method" value="<?= esc($payment['method']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Status:</label>
        <select name="status" class="form-control" required>
            <option value="pending" <?= $payment['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="paid" <?= $payment['status'] == 'paid' ? 'selected' : '' ?>>Paid</option>
        </select>
    </div>

    <div class="form-group">
        <label>Current Receipt:</label>
        <?php if ($payment['receipt']): ?>
            <a href="<?= base_url('uploads/payments/' . $payment['receipt']) ?>" target="_blank">View</a>
        <?php else: ?>
            N/A
        <?php endif; ?>
        <input type="hidden" name="old_receipt" value="<?= esc($payment['receipt']) ?>">
        <br>
        <label>Upload New Receipt (PDF only):</label><br>
        <input type="file" name="receipt" accept="application/pdf">
    </div>
    
    <div class="form-group">
        <a href="<?= base_url('landlord/payments') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Update Payment</button>
    </div>
</form>

<?= $this->endSection() ?>