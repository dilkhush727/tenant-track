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
                <div class="card-header justify-content-center"><h3 class="fw-light my-1 text-center">Login</h3></div>
                <div class="card-body">
                    <form method="post" action="/login">
                        <?= csrf_field() ?>

                        <!-- Flash error message (from Controller) -->
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger mt-3">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input type="email" name="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>"
                                   id="inputEmailAddress" placeholder="Enter email address" value="<?= old('email') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPassword">Password</label>
                            <input type="password" name="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>"
                                   id="inputPassword" placeholder="Enter password" required minlength="6">
                            <?php if (isset($validation) && $validation->hasError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" />
                                <label class="form-check-label" for="rememberPasswordCheck">Remember password</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="6LeB73ErAAAAAEGtJS-z7mXrhXYLA3QArDA5vdzr"></div>
                            <?php if (session()->getFlashdata('captcha_error')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('captcha_error') ?></div>
                            <?php endif; ?>
                        </div>


                        <!-- Submit Button -->
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small text-dark" href="javascropt:;">Forgot Password?</a>
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>                    
                </div>

                <div class="card-footer text-center">
                    <div class="small"><a href="/register" class="text-dark">Need an account? Sign up!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?= $this->endSection() ?>
