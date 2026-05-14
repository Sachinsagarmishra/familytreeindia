<?php
// Session check for all admin pages except login
if (!isset($_SESSION['admin_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit();
}
$admin_user = isset($_SESSION['admin_user']) ? $_SESSION['admin_user'] : 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? $pageTitle . ' — Admin Panel' : 'Admin Panel — Family Tree'; ?></title>
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/admin/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <!-- TinyMCE -->
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

<div class="admin-wrapper">
  <!-- MOBILE HEADER -->
  <header class="mobile-admin-header">
    <div class="mob-title">Admin Panel</div>
    <button id="menuToggle" class="menu-toggle">
      <i class="fa-solid fa-bars"></i>
    </button>
  </header>
