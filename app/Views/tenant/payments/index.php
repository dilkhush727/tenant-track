<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<div class="container-xl px-4">
    <div class="card mb-4">
        <div class="card-header">Rent Payment History</div>
        <div class="card-body">
            <?php if (empty($payments)): ?>
                <p>No rent payments found.</p>
            <?php else: ?>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Lease ID</th>
                            <th>Amount</th>
                            <th>Date Paid</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Lease ID</th>
                            <th>Amount</th>
                            <th>Date Paid</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Receipt</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td><?= esc($payment['lease_id']) ?></td>
                            <td>$<?= esc($payment['amount']) ?></td>
                            <td><?= esc($payment['date_paid']) ?></td>
                            <td><?= esc($payment['method']) ?></td>
                            <td><?= esc($payment['status']) ?></td>
                            <td>
                                <?php if (!empty($payment['receipt'])): ?>
                                    <a href="<?= base_url('uploads/payments/' . $payment['receipt']) ?>" target="_blank"><div class="badge bg-secondary text-white rounded-pill">View PDF</div></a>
                                <?php else: ?>
                                    <div class="badge bg-danger text-white rounded-pill">No File Available</div>
                                <?php endif; ?>
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