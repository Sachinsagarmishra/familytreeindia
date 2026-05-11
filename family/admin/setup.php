<?php
include_once '../includes/config.php';

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if username or email already exists
        $check = "SELECT id FROM admins WHERE username = '$username' OR email = '$email'";
        $res = $conn->query($check);

        if ($res->num_rows > 0) {
            $error = "Username or Email already exists.";
        } else {
            $sql = "INSERT INTO admins (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            
            if ($conn->query($sql) === TRUE) {
                $message = "Admin account created successfully! <a href='login.php' style='color: var(--yellow);'>Login here</a>";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Setup — Family Tree</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
  <div class="login-card">
    <div class="login-logo">
      <img src="../img/logo.png" alt="Family Tree">
    </div>
    <h1 class="login-h1">Create Admin</h1>
    <p class="login-sub">Setup your permanent administrative credentials</p>

    <?php if($error): ?>
      <div class="login-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if($message): ?>
      <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: 6px; font-size: 0.85rem; margin-bottom: 20px; text-align: center;">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label for="username">Desired Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="e.g. sachin_admin" required autofocus>
      </div>
      <div class="form-group">
        <label for="email">Admin Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="admin@familytreeindia.org" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn-login">Create Account</button>
    </form>
    
    <div style="margin-top: 24px; text-align: center; font-size: 0.75rem; color: #991b1b; font-weight: 600;">
      ⚠️ IMPORTANT: Delete this file (setup.php) after creating your account.
    </div>
  </div>
</div>

</body>
</html>
