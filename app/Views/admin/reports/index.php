<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <!-- Dashboard info widget 1-->
        <div class="card border-start-lg border-start-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold mb-1"><a href="<?= base_url('landlord/leases') ?>" class="text-primary">Total Leases</a></div>
                        <div class="h5"><?= esc($lease_count) ?></div>
                        <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                            <a href="<?= base_url('admin/reports/export/leases') ?>">
                                <button class="btn btn-primary btn-sm">Export Leases (CSV)</button>
                            </a>
                        </div>
                    </div>
                    <div class="ms-2"><i class="fas fa-file fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <!-- Dashboard info widget 2-->
        <div class="card border-start-lg border-start-secondary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold mb-1"><a href="<?= base_url('landlord/payments') ?>" class="text-secondary">Payments Received</a></div>
                        <div class="h5">$<?= esc($payment_total) ?></div>
                        <a href="<?= base_url('admin/reports/export/payments') ?>">
                            <button class="btn btn-secondary btn-sm">Export Payments (CSV)</button>
                        </a>
                    </div>
                    <div class="ms-2"><i class="fas fa-dollar fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <!-- Dashboard info widget 3-->
        <div class="card border-start-lg border-start-success h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold mb-1"><a href="<?= base_url('landlord/maintenance') ?>" class="text-success">Open Maintenance Requests</a></div>
                        <div class="h5"><?= esc($maintenance_pending) ?></div>
                        <a href="<?= base_url('admin/reports/export/maintenance') ?>">
                            <button class="btn btn-success btn-sm">Export Maintenance Requests (CSV)</button>
                        </a>
                    </div>
                    <div class="ms-2"><i class="fas fa-cog fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <!-- Dashboard info widget 3-->
        <div class="card border-start-lg border-start-success h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="small fw-bold mb-1"><a href="<?= base_url('landlord/maintenance') ?>" class="text-success">Resolved Maintenance Requests</a></div>
                        <div class="h5"><?= esc($maintenance_resolved) ?></div>
                    </div>
                    <div class="ms-2"><i class="fas fa-cog fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="<?= base_url('admin') ?>">
    <button type="button" class="btn btn-danger">Back</button>
</a>

<?= $this->endSection() ?>