<?php
error_reporting(0);
include_once 'config.php';
$date = date("Y-m-d");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - Skripsi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="icon" type="image/png" href="images/icon.jpg"/>
  <link href="assets/icon.jpg" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="?page=home" class="logo d-flex align-items-center" style="text-decoration:none">
        <img src="images/icon.jpg" style="width:50px; height:120px" alt="">
        <span class="d-none d-lg-block">Service AC</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
  </header>
  <aside id="sidebar" class="sidebar">
    <div class="d-flex align-items-center justify-content-center mb-2">
      <img src="uploads/<?php echo $_SESSION['profile'] ?>" style="width: 100px; height: 100px; border-radius: 90%;" alt="Profile Image">
    </div>

    <div class="text-center mb-0">
    <span style="font-size:20px;font-weight:bolder;color:black;"><?php echo $_SESSION['username']; ?></span>
    </div>
    <div class="text-center mb-2">
    <span style="font-weight:bolder;color:red;"><?php echo $_SESSION['level']; ?></span>
    </div>
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link" href="?page=home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
          
        </a>
      </li>
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <?php include 'controller/pageadmin.php'; ?>
  </main>

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>UPI YPTK PADANG</span></strong>. All Rights Reserved
    </div>
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
   $(document).ready(function() {
  function loadNotifications() {
    $.ajax({
      url: 'check_notifications.php',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        console.log('Success:', response); // Log the response to console
        if (response.count > 0) {
          $('#notification-badge').text(response.count);
        } else {
          $('#notification-badge').text('');
        }
      },
      error: function(xhr, status, error) {
        console.error('Error fetching notifications:', error); // Log any errors to console
      }
    });
  }

  // Call loadNotifications initially
  loadNotifications();

  // Call loadNotifications every 30 seconds (adjust as needed)
  setInterval(loadNotifications, 30000);
});

  </script>
</body>
</html>
