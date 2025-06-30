<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<div class="container-xl px-4">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">Maintenance Requests</div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Issue Type</th>
                        <th>Submitted</th>
                        <th>Resolved</th>
                        <th>Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Issue Type</th>
                        <th>Submitted</th>
                        <th>Resolved</th>
                        <th>Update</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                <?php foreach ($requests as $req): ?>
                    <tr>
                        <td><?= esc($req['tenant_name']) ?></td>
                        <td><?= esc($req['property_address']) ?></td>
                        <td><?= esc($req['issue_type']) ?></td>
                        <td><?= esc($req['submitted_at']) ?></td>
                        <td><?= esc($req['resolved_at'] ?? '-') ?></td>
                        <td>
                            <form action="<?= base_url('landlord/maintenance/update-status/' . $req['id']) ?>" method="post" class="d-flex align-items-center gap-2">
                                <?= csrf_field() ?>
                                
                                <div class="form-group mb-0">
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="submitted" <?= $req['status'] == 'submitted' ? 'selected' : '' ?>>Submitted</option>
                                        <option value="in_progress" <?= $req['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                                        <option value="resolved" <?= $req['status'] == 'resolved' ? 'selected' : '' ?>>Resolved</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-sm btn-success" title="Update Status">
                                    <i data-feather="check"></i>
                                </button>
                            </form>                            
                        </td>

                        <td>
                            <a href="<?= base_url('landlord/maintenance/view/' . $req['id']) ?>">View</a>
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