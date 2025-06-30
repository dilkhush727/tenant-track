<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h3 class="text-center py-2 auth-head">
                <a href="/" class="text-dark">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="TenantTrack Logo" width="100">
                </a>
            </h3>
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header justify-content-center"><h3 class="fw-light my-1 text-center">Register</h3></div>
                <div class="card-body">                    
                    <form method="post" action="<?= site_url('register') ?>">
                        <?= csrf_field() ?>

                        <!-- Flash success message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputNameAddress">Name</label>
                            <input type="text" name="name" class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>"
                                   id="inputNameAddress" placeholder="Name" value="<?= set_value('name') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input type="email" name="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>"
                                   id="inputEmailAddress" placeholder="Email" value="<?= set_value('email') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPasswordAddress">Password</label>
                            <input type="password" name="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>"
                                   id="inputPasswordAddress" placeholder="Password (min 6 chars)" required minlength="6">
                            <?php if (isset($validation) && $validation->hasError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Role Field -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputRoleAddress">Role</label>
                            <select name="role" class="form-control <?= isset($validation) && $validation->hasError('role') ? 'is-invalid' : '' ?>"
                                    id="inputRoleAddress" required>
                                <option value="">Select role</option>
                                <option value="tenant" <?= set_select('role', 'tenant') ?>>Tenant</option>
                                <option value="landlord" <?= set_select('role', 'landlord') ?>>Landlord</option>
                            </select>
                            <?php if (isset($validation) && $validation->hasError('role')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('role') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="6LeB73ErAAAAAEGtJS-z7mXrhXYLA3QArDA5vdzr"></div>
                            <?php if (session()->getFlashdata('captcha_error')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('captcha_error') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark">Register</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <div class="small"><a href="/login" class="text-dark">Already have an account? Login here</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?= $this->endSection() ?>
