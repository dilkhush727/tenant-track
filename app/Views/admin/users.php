<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')): ?>
    <p style="color: green"><?= session()->getFlashdata('success') ?></p>
<?php elseif(session()->getFlashdata('error')): ?>
    <p style="color: red"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<div class="container-xl px-4">
    <div class="card mb-4">
        <div class="card-header">All Users</div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>

                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= esc($u['name']) ?></td>
                        <td><?= esc($u['email']) ?></td>
                        <td><?= esc($u['role']) ?></td>
                        <td><?= esc($u['status']) ?></td>
                        <td>
                            <?php if ($u['role'] === 'landlord'): ?>
                                <form method="post" action="<?= base_url("admin/users/elevate/{$u['id']}") ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-dark btn-sm">Make Admin</button>
                                </form>
                                <?php elseif ($u['role'] === 'admin'): ?>
                                    <form method="post" action="<?= base_url("admin/users/demote/{$u['id']}") ?>" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-warning btn-sm">Demote</button>
                                    </form>
                                <?php endif; ?>

                            <form method="post" action="<?= base_url("admin/users/toggle-status/{$u['id']}") ?>" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn <?= ($u['status'] === 'active') ? 'btn-danger' : 'btn-success' ?> btn-sm">
                                    <?= ($u['status'] === 'active') ? 'Disable' : 'Enable' ?>
                                </button>
                            </form>
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