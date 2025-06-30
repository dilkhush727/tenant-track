<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<div class="container-xl px-4">

    <div class="mb-2">
        <a href="<?= base_url('tenant/maintenance/create') ?>">
            <button class="btn btn-dark btn-sm"><i data-feather="plus"></i> New Request</button>
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">Maintenance Requests</div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Issue Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                        <th>Feedback</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Issue Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                        <th>Feedback</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                <?php foreach ($requests as $req): ?>
                    <tr>
                        <td><?= esc($req['id']) ?></td>
                        <td><?= esc($req['issue_type']) ?></td>
                        <td><?= esc($req['description']) ?></td>
                        <td><?= esc(ucwords(str_replace('_', ' ', strtolower($req['status'])))) ?></td>
                        <td><?= esc($req['submitted_at']) ?></td>
                        <td>
                            <?php if ($req['status'] === 'resolved'): ?>
                                <?php if ($req['feedback']): ?>
                                    <div class="badge bg-success text-white rounded-pill">Feedback Submitted</div>
                                <?php else: ?>
                                    <a href="<?= base_url('tenant/maintenance/feedback/' . $req['id']) ?>">
                                        <button class="btn btn-primary btn-sm">Give Feedback</button>
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="<?= base_url('tenant/maintenance/view/' . $req['id']) ?>">View</a>
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