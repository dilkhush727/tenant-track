<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between">
    <h2>Your Properties</h2>
    <a href="<?= base_url('landlord/properties/create') ?>">
        <button class="btn btn-sm btn-dark"><i data-feather="plus"></i> Add Property</button>
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
<p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<?php foreach ($properties as $p): ?>
    <div class="card card-icon mb-4">
        <div class="row g-0">
            <div class="col-auto card-icon-aside bg-light">
                <i data-feather="home" class="text-dark"></i>
            </div>
            <div class="col">
                <div class="card-body py-4">
                    <h5 class="card-title text-dark mb-2">
                        <strong><?= esc($p['address']) ?></strong> - <?= esc($p['type']) ?>
                    </h5>
                    <p class="card-text mb-1"><?= esc($p['description']) ?></p>
                    <div class="small text-muted"><?= esc($p['created_at']) ?></div>

                    <div>
                        <a href="<?= base_url('landlord/properties/edit/'.$p['id']) ?>" class="btn btn-dark btn-sm">Edit</a>
                        <form action="<?= base_url('landlord/properties/delete/'.$p['id']) ?>" method="post" class="d-inline">
                            <button type="submit" onclick="return confirm('Delete this property?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>