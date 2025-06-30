<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Leave Feedback</h2>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form method="post" class="bs-form" action="<?= base_url('tenant/maintenance/feedback/' . $request['id']) ?>">
  <div class="form-group">
    <label for="feedback">Your feedback:</label><br>
    <textarea name="feedback" class="form-control" rows="5" cols="50" required></textarea>
  </div>

  <div class="form-group">
    <a href="<?= base_url('tenant/maintenance') ?>">
        <button type="button" class="btn btn-danger">Back</button>
    </a>
    <button type="submit" class="btn btn-dark">Submit Feedback</button>
  </div>
</form>

<?= $this->endSection() ?>