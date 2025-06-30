<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<div class="container-xl px-4">
    <div class="card mb-4">
        <div class="card-header">Lease Agreements</div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Monthly Rent</th>
                        <th>Lease File</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Property</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Monthly Rent</th>
                        <th>Lease File</th>
                    </tr>
                </tfoot>
                <tbody>

                <?php foreach ($leases as $lease): ?>
                    <tr>
                        <td><?= esc($lease['property_id']) ?></td>
                        <td><?= esc($lease['start_date']) ?></td>
                        <td><?= esc($lease['end_date']) ?></td>
                        <td>$<?= esc($lease['monthly_rent']) ?></td>
                        <td>
                            <?php if ($lease['agreement_file']): ?>
                                <a href="<?= base_url('uploads/leases/' . $lease['agreement_file']) ?>" target="_blank"><div class="badge bg-secondary text-white rounded-pill">View PDF</div></a>
                            <?php else: ?>
                                <div class="badge bg-danger text-white rounded-pill">No File Available</div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="<?= base_url('js/datatables/datatables-simple-demo.js') ?>"></script>

<?= $this->endSection() ?>