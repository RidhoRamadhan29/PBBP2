        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-code"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">
                    <style>
                        .logo-container {
                            display: flex;
                            /* Menggunakan flexbox */
                            justify-content: center;
                            /* Menyusun item secara horizontal di tengah */
                            align-items: center;
                            /* Menyusun item secara vertikal di tengah */
                        }

                        .logo {
                            max-width: 70px;
                            /* Lebar maksimum gambar */
                            max-height: 70px;
                            /* Tinggi maksimum gambar */
                            width: auto;
                            /* Lebar gambar disesuaikan agar sesuai dengan tinggi maksimum */
                            height: auto;
                            /* Tinggi gambar disesuaikan agar sesuai dengan lebar maksimum */
                            margin: 0 5px;
                            /* Memberikan ruang di antara kedua logo */
                            margin-top: 50px;
                        }
                    </style>

                    <div class="logo-container">
                        <img class="logo" src="<?= base_url('assets/img/logo/lombok barat.png') ?>" alt="LOMBOK BARAT">
                    </div>
                    <h6><b>PENGARSIPAN DOKUMEN PBB-P2</b></h6>
                </div>
            </a>

            <!-- Divider -->
            <br>
            <br>
            <hr class="sidebar-divider">
            <?php
            // Query Menu
            $role_id = $this->session->userdata('role_id');
            $menu = $this->menu->showMenu($role_id);
            ?>

            <!-- Looping menu -->
            <?php foreach ($menu as $m) : ?>
                <div class="sidebar-heading">
                    <?= $m['menu']; ?>
                </div>

                <!-- Sub Menu -->
                <?php
                $menuId = $m['id'];
                $subMenu = $this->menu->showSubMenu($menuId);
                ?>

                <?php foreach ($subMenu as $sm) : ?>
                    <?php if ($title == $sm['title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>

                        <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                            <i class="<?= $sm['icon']; ?>"></i>
                            <span><?= $sm['title']; ?></span></a>
                        </li>
                    <?php endforeach; ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider mt-3">
                <?php endforeach; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

        </ul>
        <!-- End of Sidebar -->