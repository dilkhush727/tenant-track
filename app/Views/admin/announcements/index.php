<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<div class="mb-2">
    <a href="<?= base_url('admin/announcements/create') ?>">
        <button class="btn btn-dark btn-sm"><i data-feather="plus"></i> Create New</button>
    </a>
</div>

<div class="row">
    <div class="col-xxl-12 mb-4">      
        <div class="card mb-4">
            <div class="card-header">Announcements</div>
            <div class="list-group list-group-flush small">

            <?php if (!empty($announcements)): ?>
                <?php foreach ($announcements as $announcement): ?>

                    <a class="list-group-item list-group-item-action" href="javascript:;">
                        <h6><?= esc($announcement['title']) ?></h6>

                        <p class="mb-0"><?= esc($announcement['message']) ?></p>

                        <small class="text-muted"><em>Posted on <?= esc($announcement['created_at']) ?></em></small>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="list-group-item list-group-item-action">No announcements at the moment.</p>
            <?php endif; ?>
            
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>