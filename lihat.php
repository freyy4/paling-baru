<?php include "head.php"; ?>
<?php
    $id_daftar = $_SESSION['id_daftar'];
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:index.php");
    }
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?php include "navbar.php"; ?>
        <?php include "sidebar.php"; ?>
        <div class="content-wrapper">
            <section class="content">
                <iframe
                    src="https://id.widgets.investing.com/live-currency-cross-rates?theme=darkTheme&pairs=3,2,4,7,5,6,1031293,1841,1031292,1843,1031290,1031291,1847,1848,1849,1853,1031289"
                    width="100%" height="100%" frameborder="0" allowtransparency="true" marginwidth="0"
                    marginheight="0"></iframe>
        </div>
        </section>
    </div>
    </div>
</body>
<?php include "foot.php"; ?>

</html>