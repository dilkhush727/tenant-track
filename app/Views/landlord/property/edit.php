<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Property</h2>
<form action="<?= base_url('landlord/properties/update/'.$property['id']) ?>" class="bs-form" method="post">
    <div class="form-group">
        <label>Address:</label>
        <input type="text" name="address" value="<?= esc($property['address']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Type:</label>
        <input type="text" name="type" value="<?= esc($property['type']) ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control" required><?= esc($property['description']) ?></textarea>
    </div>

    <div class="form-group">
        <a href="<?= base_url('landlord/properties') ?>">
            <button type="button" class="btn btn-danger">Back</button>
        </a>
        <button type="submit" class="btn btn-dark">Update Property</button>
    </div>
</form>

<?= $this->endSection() ?>