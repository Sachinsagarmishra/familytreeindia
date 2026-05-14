<?php
include_once '../includes/config.php';
$pageTitle = "Partner Logos";
$activePage = "partners";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$msg = "";
$error = "";

// Handle Upload
if (isset($_POST['add_partner'])) {
    $name = $conn->real_escape_string($_POST['name']);
    
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
        $filename = $_FILES['logo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_name = time() . '_' . preg_replace("/[^a-zA-Z0-9]/", "_", $name) . '.' . $ext;
            $target = "../img/partners/" . $new_name;
            
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $target)) {
                $conn->query("INSERT INTO partners (name, logo) VALUES ('$name', '$new_name')");
                $msg = "Partner added successfully!";
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "Invalid file type. Allowed: " . implode(', ', $allowed);
        }
    } else {
        $error = "Please select a logo file.";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $res = $conn->query("SELECT logo FROM partners WHERE id = $id");
    if ($row = $res->fetch_assoc()) {
        $filepath = "../img/partners/" . $row['logo'];
        if (file_exists($filepath)) unlink($filepath);
        $conn->query("DELETE FROM partners WHERE id = $id");
        $msg = "Partner deleted successfully!";
    }
}

// Fetch all partners
$partners = $conn->query("SELECT * FROM partners ORDER BY order_index ASC, id DESC");
?>

<main class="main-content">
  <header class="header-admin">
    <div class="welcome-msg">
      <h2>Partner Logos</h2>
      <p>Manage institutions and partners shown on the About and Home pages.</p>
    </div>
    <div class="header-actions">
       <button class="btn-login" style="width: auto; margin-top: 0;" onclick="document.getElementById('addModal').style.display='flex'">
         <i class="fa-solid fa-plus"></i> Add New Partner
       </button>
    </div>
  </header>

  <?php if($msg): ?>
    <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
      <?php echo $msg; ?>
    </div>
  <?php endif; ?>

  <?php if($error): ?>
    <div style="padding: 16px; background: #fee2e2; color: #991b1b; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
      <?php echo $error; ?>
    </div>
  <?php endif; ?>

  <div class="settings-card" style="padding: 0; overflow: hidden;">
    <table class="leads-table" style="width: 100%; border-collapse: collapse;">
      <thead>
        <tr style="background: var(--warm-white); text-align: left;">
          <th style="padding: 16px; width: 80px;">Preview</th>
          <th style="padding: 16px;">Partner Name</th>
          <th style="padding: 16px;">Logo Filename</th>
          <th style="padding: 16px; text-align: right;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($partners->num_rows > 0): ?>
          <?php while($p = $partners->fetch_assoc()): ?>
            <tr style="border-bottom: 1px solid #eee;">
              <td style="padding: 16px;">
                <div style="width: 50px; height: 50px; background: #f9f9f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 5px; border: 1px solid #eee;">
                  <img src="../img/partners/<?php echo $p['logo']; ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>
              </td>
              <td style="padding: 16px; font-weight: 600;"><?php echo htmlspecialchars($p['name']); ?></td>
              <td style="padding: 16px; font-size: 0.8rem; color: #666;"><?php echo $p['logo']; ?></td>
              <td style="padding: 16px; text-align: right;">
                <a href="?delete=<?php echo $p['id']; ?>" style="color: #ef4444; font-size: 1.2rem;" onclick="return confirm('Delete this partner?')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" style="padding: 40px; text-align: center; color: #999;">No partners added yet.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<!-- ADD MODAL -->
<div id="addModal" class="lead-modal">
  <div class="lead-modal-content">
    <button class="lead-modal-close" onclick="closeModal()">✕</button>
    <h3>Add New Partner</h3>
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label>Partner Name</label>
        <input type="text" name="name" class="form-control" placeholder="e.g. Bihar Govt" required>
      </div>
      <div class="form-group">
        <label>Logo File (SVG/PNG/JPG)</label>
        <input type="file" name="logo" class="form-control" accept=".svg,.png,.jpg,.jpeg,.webp" required>
      </div>
      <button type="submit" name="add_partner" class="btn-login">Upload & Add</button>
    </form>
  </div>
</div>

<script>
const addModal = document.getElementById('addModal');

function openModal() {
  addModal.classList.add('active');
}

function closeModal() {
  addModal.classList.remove('active');
}

// Close on outside click
window.onclick = function(event) {
  if (event.target == addModal) {
    closeModal();
  }
}
</script>

<?php include_once 'includes/footer.php'; ?>
