<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        PT. Crystal Biru Meuligo
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <p class="text-white">
                    <?php
                        date_default_timezone_set('Asia/Jakarta'); // Sesuaikan zona waktu sesuai dengan lokasi Anda
                        $jam = date('H');
                        if ($jam >= 5 && $jam < 12) {
                            $greeting = 'Selamat Pagi !';
                        } elseif ($jam >= 12 && $jam < 15) {
                            $greeting = 'Selamat Siang !';
                        } elseif($jam >= 15 && $jam < 18) {
                            $greeting = 'Selamat Sore !';
                        } else {
                            $greeting = 'Selamat Malam !';
                        }
                        echo $greeting;
                    ?>
                </p>
                <a href="profil.php" class="d-block"><i class="fa-solid fa-person"></i>
                    <?php echo $_SESSION['nama']; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dash.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="chat.php" target="blank" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Chat dengan Admin
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>