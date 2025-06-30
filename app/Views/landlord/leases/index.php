<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<div class="container-xl px-4">
    <div class="mb-2">
        <a href="<?= base_url('landlord/leases/create') ?>">
            <button class="btn btn-dark btn-sm"><i data-feather="plus"></i> Add Lease</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">Lease Agreements</div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Tenant ID</th>
                        <th>Property ID</th>
                        <th>Rent</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Lease File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tenant ID</th>
                        <th>Property ID</th>
                        <th>Rent</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Lease File</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                <?php foreach ($leases as $lease): ?>
                    <tr>
                        <td><?= esc($lease['tenant_id']) ?></td>
                        <td><?= esc($lease['property_id']) ?></td>
                        <td>$<?= esc($lease['monthly_rent']) ?></td>
                        <td><?= esc($lease['start_date']) ?></td>
                        <td><?= esc($lease['end_date']) ?></td>
                        <td>
                            <?php if (!empty($lease['agreement_file'])): ?>
                                <a href="<?= base_url('uploads/leases/' . $lease['agreement_file']) ?>" target="_blank"><div class="badge bg-secondary text-white rounded-pill">View</div></a> |
                                <a href="<?= base_url('uploads/leases/' . $lease['agreement_file']) ?>" download><div class="badge bg-dark text-white rounded-pill">Download</div></a>
                            <?php else: ?>
                                <div class="badge bg-danger text-white rounded-pill">Not Uploaded</div>
                            <?php endif; ?>
                        </td>
                        <td><a href="<?= base_url('landlord/leases/edit/' . $lease['id']) ?>"><div class="badge bg-warning text-white rounded-pill">Edit</div></a></td>
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