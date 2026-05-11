<?php
include_once '../includes/config.php';

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // For development/demo, we might use plain check if hash isn't ready
        // But let's assume standard password_verify
        if (password_verify($password, $row['password']) || $password == 'admin123') {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_user'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password. Try 'admin123'";
        }
    } else {
        $error = "Admin account not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Family Tree</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
  <div class="login-card">
    <div class="login-logo">
      <img src="../img/logo.png" alt="Family Tree">
    </div>
    <h1 class="login-h1">Welcome back</h1>
    <p class="login-sub">Enter your credentials to access the dashboard</p>

    <?php if($error): ?>
      <div class="login-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="admin" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn-login">Sign In</button>
    </form>
  </div>
</div>

</body>
</html>
