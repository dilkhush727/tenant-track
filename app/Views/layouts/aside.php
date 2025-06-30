<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <?php if (session('role') === 'tenant'): ?>
                    <a class="nav-link mt-3 <?= (current_url() == base_url('tenant')) ? 'active' : '' ?>" href="<?= base_url('tenant') ?>">
                        <div class="nav-link-icon"><i class="fa fa-dashboard"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('tenant/leases')) ? 'active' : '' ?>" href="<?= base_url('tenant/leases') ?>">
                        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                        My Lease
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('tenant/payments')) ? 'active' : '' ?>" href="<?= base_url('tenant/payments') ?>">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        Rent Payments
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('tenant/maintenance')) ? 'active' : '' ?>" href="<?= base_url('tenant/maintenance') ?>">
                        <div class="nav-link-icon"><i data-feather="tool"></i></div>
                        Maintenance Requests
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('messages')) ? 'active' : '' ?>" href="<?= base_url('messages') ?>">
                        <div class="nav-link-icon"><i data-feather="message-square"></i></div>
                        Messages
                    </a>

                <?php elseif (session('role') === 'landlord'): ?>
                    <a class="nav-link mt-3 <?= (current_url() == base_url('landlord')) ? 'active' : '' ?>" href="<?= base_url('landlord') ?>">
                        <div class="nav-link-icon"><i class="fa fa-dashboard"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('landlord/properties')) ? 'active' : '' ?>" href="<?= base_url('landlord/properties') ?>">
                        <div class="nav-link-icon"><i data-feather="home"></i></div>
                        Manage Properties
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('landlord/leases')) ? 'active' : '' ?>" href="<?= base_url('landlord/leases') ?>">
                        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                        Manage Leases
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('landlord/payments')) ? 'active' : '' ?>" href="<?= base_url('landlord/payments') ?>">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        Payment History
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('landlord/maintenance')) ? 'active' : '' ?>" href="<?= base_url('landlord/maintenance') ?>">
                        <div class="nav-link-icon"><i data-feather="tool"></i></div>
                        Maintenance Tracker
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('landlord/reports')) ? 'active' : '' ?>" href="<?= base_url('landlord/reports') ?>">
                        <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                        Reports
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('messages')) ? 'active' : '' ?>" href="<?= base_url('messages') ?>">
                        <div class="nav-link-icon"><i data-feather="message-square"></i></div>
                        Messages
                    </a>

                <?php elseif (session('role') === 'admin'): ?>
                    <a class="nav-link mt-3 <?= (current_url() == base_url('admin')) ? 'active' : '' ?>" href="<?= base_url('admin') ?>">
                        <div class="nav-link-icon"><i class="fa fa-dashboard"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('admin/users')) ? 'active' : '' ?>" href="<?= base_url('admin/users') ?>">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Manage Users
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('admin/announcements')) ? 'active' : '' ?>" href="<?= base_url('admin/announcements') ?>">
                        <div class="nav-link-icon"><i data-feather="volume-2"></i></div>
                        Announcements
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('messages')) ? 'active' : '' ?>" href="<?= base_url('messages') ?>">
                        <div class="nav-link-icon"><i data-feather="message-square"></i></div>
                        Messages
                    </a>
                    <a class="nav-link <?= (current_url() == base_url('admin/reports')) ? 'active' : '' ?>" href="<?= base_url('admin/reports') ?>">
                        <div class="nav-link-icon"><i data-feather="download"></i></div>
                        Reports
                    </a>
                <?php endif; ?>

                <a class="nav-link" href="<?= base_url('logout') ?>">
                    <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                    Exit
                </a>

            </div>
        </div>
    </nav>
</div>
