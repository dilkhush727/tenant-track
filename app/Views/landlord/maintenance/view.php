<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2 class="mb-3">Maintenance Request Details</h2>

<div class="row">
    <div class="col-xl-6 col-md-8 col-sm-12 mb-4">
        <div class="card mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-2">
                    <div>
                    <div class="badge bg-secondary text-white"><?= esc(ucwords(str_replace('_', ' ', strtolower($request['status'])))) ?></div>
                    </div>
                    <small>
                        <?php
                            $submittedAt = new DateTime($request['submitted_at']);
                            echo $submittedAt->format('jS F Y, h:i A');
                        ?>
                    </small>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div>
                        <?= esc($request['property_address']) ?>
                    </div>
                    <small>
                        <strong>Requested by:</strong> <?= esc($request['tenant_name']) ?>
                    </small>
                </div>

            <?php if ($request['image']): ?>
                <img src="<?= base_url('uploads/maintenance/' . $request['image']) ?>" width="100%" alt="Uploaded image">
            <?php endif; ?>

                <h4 class="mt-3"><strong></strong> <?= esc($request['issue_type']) ?></h4>
                <p class="mb-4"><?= esc($request['description']) ?></p>

                <?php if ($request['feedback']): ?>
                    <div class="bg-light p-3 shadow-sm mb-4">
                        <strong>Feedback:</strong>
                        <p class="mb-0"><?= esc($request['feedback']) ?></p>
                    </div>
                <?php endif; ?>

                <div class="text-center">
                    <a href="<?= base_url('landlord/maintenance') ?>">
                        <button type="button" class="btn btn-danger">Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>