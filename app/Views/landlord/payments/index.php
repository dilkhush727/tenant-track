<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<div class="container-xl px-4">
    <div class="mb-2">
        <a href="<?= base_url('landlord/payments/create') ?>">
            <button class="btn btn-dark btn-sm"><i data-feather="plus"></i> Record New Payment</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">All Payments</div>
        <div class="card-body">
            <?php if (empty($payments)): ?>
                <p>No rent payments found.</p>
            <?php else: ?>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lease ID</th>
                            <th>Amount</th>
                            <th>Date Paid</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Lease ID</th>
                            <th>Amount</th>
                            <th>Date Paid</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td><?= esc($payment['id']) ?></td>
                            <td><?= esc($payment['lease_id']) ?></td>
                            <td>$<?= esc($payment['amount']) ?></td>
                            <td><?= esc($payment['date_paid']) ?></td>
                            <td><?= esc($payment['method']) ?></td>
                            <td><?= esc($payment['status']) ?></td>
                            <td>
                                <a href="<?= base_url('landlord/payments/edit/' . $payment['id']) ?>"><div class="badge bg-warning text-white rounded-pill">Edit</div></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="<?= base_url('js/datatables/datatables-simple-demo.js') ?>"></script>

<?= $this->endSection() ?>