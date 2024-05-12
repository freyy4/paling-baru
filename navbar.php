<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link text-danger" onclick="return logout(event)" href="logout.php">
                <i class="fa fa-right-from-bracket"></i> Logout
            </a>
        </li>
    </ul>
</nav>

<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="https://lh5.googleusercontent.com/p/AF1QipNfUmvSkwxbdmqVDIV9lunTGVr8kfegFICs99Qh" alt="AdminLTELogo" height="60" width="60">
  </div> -->

<script>
function logout(event) {
    event.preventDefault(); // Prevent the default link behavior

    Swal.fire({
        text: 'Apakah Anda yakin ingin Keluar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Keluar!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Ya, hapus!", proceed with the deletion
            window.location.href = event.target.href;
        }
    });
}
</script>