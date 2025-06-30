<!DOCTYPE html>
<html lang="en">
    <?= $this->include('layouts/head') ?>

    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: -1;
            background-image: url('<?= base_url('assets/img/home-banner.jpg') ?>');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.6; /* Optional: adjust for overlay effect */
        }
        @media (max-width: 767.98px) {
            body {
                background-image: url('<?= base_url('assets/img/home-banner-mobile.jpg') ?>');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
        }
        .auth-head{
            background: #148454;
        }
    </style>
    <body>
        
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>             
                    <div class="mt-5">
                        <?= $this->renderSection('content') ?>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
