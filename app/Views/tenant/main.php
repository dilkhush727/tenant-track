<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">Lease</div>
            <div class="card-body">
                <?php if ($lease): ?>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                            <div class="me-3">
                                <i class="fa fa-map-marker"></i>&nbsp;
                                <?= esc($property['address']) ?>
                            </div>
                        </div>
                        
                        <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                            <div class="me-3">
                                <i class="fa fa-clock"></i>&nbsp;
                                <?= esc($lease['start_date']) ?> to <?= esc($lease['end_date']) ?>
                            </div>
                        </div>
                        
                        <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                            <div class="me-3">
                                <i class="fa fa-dollar"></i>&nbsp;
                                $<?= esc($lease['monthly_rent']) ?> per month
                            </div>
                        </div>
                        
                        <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                            <div class="me-3">
                                <?php if (!empty($lease['agreement_file'])): ?>
                                    <a href="<?= base_url('uploads/' . $lease['agreement_file']) ?>" target="_blank"><strong>View Agreement File</strong></a>
                                <?php else: ?>
                                    Not available
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No active lease found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xxl-8 mb-4">      
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
                <p>No announcements at the moment.</p>
            <?php endif; ?>
            
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>