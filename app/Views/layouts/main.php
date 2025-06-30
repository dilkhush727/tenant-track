<!DOCTYPE html>
<html lang="en">
    <?= $this->include('layouts/head') ?>
    <body class="nav-fixed">
        <?= $this->include('layouts/header') ?>
        
        <div id="layoutSidenav">
            <?= $this->include('layouts/aside') ?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- Main page content-->                    
                    <div class="container-xl px-4 mt-5">

                        <?= $this->renderSection('content') ?>
                        
                    </div>
                </main>
            </div>
        </div>

        <?= $this->include('layouts/footer') ?>

    </body>
</html>
