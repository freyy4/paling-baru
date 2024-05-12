  <?php
  session_start();
  if (empty($_SESSION['login'])) {
    header("Location:../../index.php");
  }
  $user = $_SESSION['nama'];
  ?>
  
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="assets/images/faces/face0.png" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal"><?php echo $user; ?></h5>
              <span>Admin Daerah</span>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="index.php">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
    </ul>
  </nav>