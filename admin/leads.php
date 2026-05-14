<?php
include_once '../includes/config.php';
$pageTitle = "Contact Leads";
$activePage = "leads";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

// Handle Single/Bulk Deletion
if (isset($_POST['delete_leads'])) {
    $ids = $_POST['lead_ids'];
    if (!empty($ids)) {
        $ids_str = implode(',', array_map('intval', $ids));
        $conn->query("DELETE FROM leads WHERE id IN ($ids_str)");
        $delete_msg = count($ids) . " lead(s) deleted successfully.";
    }
}

if (isset($_GET['delete_single'])) {
    $id = intval($_GET['delete_single']);
    $conn->query("DELETE FROM leads WHERE id = $id");
    $delete_msg = "Lead deleted successfully.";
}

// FILTERS & SEARCH
$where = " WHERE 1=1 ";
$params = [];

// Search
if (!empty($_GET['search'])) {
    $s = $conn->real_escape_string($_GET['search']);
    $where .= " AND (name LIKE '%$s%' OR email LIKE '%$s%' OR phone LIKE '%$s%' OR company LIKE '%$s%') ";
}

// Date Filter
if (!empty($_GET['date_filter'])) {
    $df = $_GET['date_filter'];
    if ($df == 'today') {
        $where .= " AND DATE(created_at) = CURDATE() ";
    } elseif ($df == 'week') {
        $where .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) ";
    } elseif ($df == 'month') {
        $where .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) ";
    }
}

// Custom Date Range
if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $sd = $conn->real_escape_string($_GET['start_date']);
    $ed = $conn->real_escape_string($_GET['end_date']);
    $where .= " AND DATE(created_at) BETWEEN '$sd' AND '$ed' ";
}

// PAGINATION
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$page = isset($_GET['p']) ? intval($_GET['p']) : 1;
$offset = ($page - 1) * $limit;

$total_res = $conn->query("SELECT COUNT(id) as total FROM leads $where");
$total_rows = $total_res->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Final Query
$sql = "SELECT * FROM leads $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<style>
  .leads-filters { display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-end; margin-bottom: 24px; background: #fff; padding: 24px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); }
  .filter-group { display: flex; flex-direction: column; gap: 8px; }
  .filter-group label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--green-mid); }
  .leads-table th { font-weight: 700; color: var(--green-dark); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
  .leads-table td { vertical-align: top; }
  .pagination { display: flex; align-items: center; justify-content: space-between; margin-top: 24px; padding: 0 10px; }
  .page-links { display: flex; gap: 8px; }
  .page-link { display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; background: #fff; border: 1px solid rgba(0,0,0,0.1); text-decoration: none; color: #000; font-weight: 600; transition: 0.3s; }
  .page-link.active { background: var(--yellow); border-color: var(--yellow); }
  .page-link:hover:not(.active) { background: var(--warm-white); }
  .bulk-actions { margin-bottom: 16px; display: none; }
  .lead-checkbox { transform: scale(1.2); cursor: pointer; }
  .btn-delete-multi { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 8px 16px; border-radius: 6px; font-weight: 700; font-size: 0.8rem; cursor: pointer; }
  .btn-delete-multi:hover { background: #fecaca; }
  .status-badge { background: #eef2ff; color: #4338ca; padding: 4px 8px; border-radius: 4px; font-size: 0.7rem; font-weight: 700; }
  
  /* Modal Styles */
  .lead-modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; }
  .lead-modal.active { display: flex; }
  .lead-modal-content { background: #fff; width: 100%; max-width: 600px; padding: 40px; border-radius: 20px; position: relative; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
  .lead-modal-close { position: absolute; right: 20px; top: 20px; background: #f0f0f0; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; }
  .lead-modal-header { margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
  .lead-modal-header h3 { font-family: 'Fraunces', serif; font-size: 1.8rem; margin: 0; }
  .lead-detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  .detail-item { margin-bottom: 15px; }
  .detail-label { font-size: 0.7rem; text-transform: uppercase; font-weight: 700; color: #888; margin-bottom: 4px; }
  .detail-val { font-weight: 600; color: #222; }
  .detail-full { grid-column: span 2; }
  .source-badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; background: #f0fdf4; color: #166534; }
  .source-badge.popup { background: #fff7ed; color: #9a3412; }
</style>

<main class="main-content">
  <header class="header-admin">
    <div class="welcome-msg">
      <h2>Contact Leads</h2>
      <p>Analyze and manage submissions (<?php echo $total_rows; ?> Total)</p>
    </div>
  </header>

  <?php if(isset($delete_msg)): ?>
    <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
      <?php echo $delete_msg; ?>
    </div>
  <?php endif; ?>

  <!-- FILTERS BAR -->
  <form method="GET" action="" class="leads-filters">
    <div class="filter-group" style="flex: 1; min-width: 200px;">
      <label>Search Leads</label>
      <input type="text" name="search" class="form-control" placeholder="Name, Email, Phone..." value="<?php echo $_GET['search'] ?? ''; ?>">
    </div>
    
    <div class="filter-group">
      <label>Quick Filter</label>
      <select name="date_filter" class="form-control">
        <option value="">All Time</option>
        <option value="today" <?php echo ($_GET['date_filter'] ?? '') == 'today' ? 'selected' : ''; ?>>Today</option>
        <option value="week" <?php echo ($_GET['date_filter'] ?? '') == 'week' ? 'selected' : ''; ?>>Last 7 Days</option>
        <option value="month" <?php echo ($_GET['date_filter'] ?? '') == 'month' ? 'selected' : ''; ?>>Last 30 Days</option>
      </select>
    </div>

    <div class="filter-group">
      <label>Custom Range</label>
      <div style="display: flex; gap: 8px; align-items: center;">
        <input type="date" name="start_date" class="form-control" style="padding: 10px;" value="<?php echo $_GET['start_date'] ?? ''; ?>">
        <span style="opacity: 0.4;">to</span>
        <input type="date" name="end_date" class="form-control" style="padding: 10px;" value="<?php echo $_GET['end_date'] ?? ''; ?>">
      </div>
    </div>

    <button type="submit" class="btn-login" style="width: auto; margin-top: 0; padding: 14px 24px;">Apply</button>
    <a href="leads.php" class="btn-login" style="width: auto; margin-top: 0; padding: 14px 24px; background: #eee; color: #666; text-decoration: none;">Reset</a>
  </form>

  <!-- TABLE -->
  <form id="bulkForm" method="POST" action="">
    <div class="bulk-actions" id="bulkActions">
      <button type="submit" name="delete_leads" class="btn-delete-multi" onclick="return confirm('Are you sure you want to delete selected leads?')">
        <i class="fa-solid fa-trash-can"></i> Delete Selected
      </button>
    </div>

    <div class="leads-table-container" style="background: #fff; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); overflow: hidden;">
      <table class="leads-table" style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
        <thead>
          <tr style="background: var(--warm-white); text-align: left;">
            <th style="padding: 16px; width: 40px;">
              <input type="checkbox" id="selectAll" class="lead-checkbox">
            </th>
            <th style="padding: 16px;">Date</th>
            <th style="padding: 16px;">Contact Information</th>
            <th style="padding: 16px;">Interest</th>
            <th style="padding: 16px;">Message</th>
            <th style="padding: 16px; text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                  <input type="checkbox" name="lead_ids[]" value="<?php echo $row['id']; ?>" class="lead-checkbox lead-item-check">
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05); color: rgba(0,0,0,0.5);">
                  <?php echo date('d M, Y', strtotime($row['created_at'])); ?><br>
                  <small><?php echo date('H:i', strtotime($row['created_at'])); ?></small>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                  <div style="font-weight: 700; margin-bottom: 4px;"><?php echo htmlspecialchars($row['name']); ?></div>
                  <div style="font-size: 0.85rem; color: var(--green-mid);"><?php echo $row['email']; ?></div>
                  <div style="font-size: 0.85rem; opacity: 0.6;"><?php echo $row['phone']; ?></div>
                  <?php if($row['company']): ?><div style="font-size: 0.8rem; margin-top: 4px; color: #888;">🏢 <?php echo htmlspecialchars($row['company']); ?></div><?php endif; ?>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                  <span class="status-badge"><?php echo $row['interest']; ?></span>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05); max-width: 250px;">
                  <div style="font-size: 0.85rem; line-height: 1.5; color: #444;"><?php echo nl2br(htmlspecialchars($row['message'])); ?></div>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05); text-align: right;">
                  <a href="javascript:void(0)" class="view-lead-btn" 
                     data-lead='<?php echo json_encode($row); ?>'
                     style="color: var(--green-mid); font-size: 1.1rem; margin-right: 12px;" title="View Details">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <a href="?delete_single=<?php echo $row['id']; ?>" style="color: #ef4444; font-size: 1.1rem;" onclick="return confirm('Delete this lead?')" title="Delete">
                    <i class="fa-solid fa-circle-xmark"></i>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" style="padding: 60px; text-align: center;">
                <img src="../img/favicon.png" style="width: 40px; opacity: 0.1; margin-bottom: 12px;">
                <p style="color: rgba(0,0,0,0.3); font-weight: 600;">No submissions match your criteria.</p>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </form>

  <!-- PAGINATION UI -->
  <?php if ($total_pages > 1): ?>
  <div class="pagination">
    <div style="font-size: 0.85rem; opacity: 0.5;">
      Showing <?php echo $offset + 1; ?> - <?php echo min($offset + $limit, $total_rows); ?> of <?php echo $total_rows; ?>
    </div>
    <div class="page-links">
      <?php if($page > 1): ?>
        <a href="?<?php echo http_build_query(array_merge($_GET, ['p' => $page-1])); ?>" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
      <?php endif; ?>

      <?php for($i=1; $i<=$total_pages; $i++): ?>
        <?php if($i == 1 || $i == $total_pages || ($i >= $page-1 && $i <= $page+1)): ?>
          <a href="?<?php echo http_build_query(array_merge($_GET, ['p' => $i])); ?>" class="page-link <?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php elseif($i == $page-2 || $i == $page+2): ?>
          <span style="padding: 8px;">...</span>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if($page < $total_pages): ?>
        <a href="?<?php echo http_build_query(array_merge($_GET, ['p' => $page+1])); ?>" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
      <?php endif; ?>
    </div>
    <div class="limit-selector">
      <select onchange="location = this.value;" class="form-control" style="width: auto; padding: 8px 30px 8px 12px; font-size: 0.85rem;">
        <?php foreach([10, 25, 50, 100] as $l): ?>
          <option value="?<?php echo http_build_query(array_merge($_GET, ['limit' => $l, 'p' => 1])); ?>" <?php echo ($limit == $l) ? 'selected' : ''; ?>><?php echo $l; ?> per page</option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <?php endif; ?>
</main>

  <!-- DETAILS MODAL -->
  <div class="lead-modal" id="leadModal">
    <div class="lead-modal-content">
      <button class="lead-modal-close" onclick="closeModal()">✕</button>
      <div class="lead-modal-header">
        <h3 id="m-name">Lead Details</h3>
        <p style="font-size: 0.85rem; color: #888; margin-top: 5px;" id="m-date"></p>
      </div>
      <div class="lead-detail-grid">
        <div class="detail-item">
          <div class="detail-label">Email ID</div>
          <div class="detail-val" id="m-email"></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Phone Number</div>
          <div class="detail-val" id="m-phone"></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Organization</div>
          <div class="detail-val" id="m-company"></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Interest</div>
          <div class="detail-val" id="m-interest"></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Location (State)</div>
          <div class="detail-val" id="m-state" style="color: #e05a1a;"></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Source</div>
          <div id="m-source"></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">IP Address</div>
          <div class="detail-val" id="m-ip" style="font-family: monospace; font-size: 0.8rem;"></div>
        </div>
        <div class="detail-item detail-full">
          <div class="detail-label">Message</div>
          <div class="detail-val" id="m-message" style="background: #f9f9f9; padding: 15px; border-radius: 10px; font-weight: 400; line-height: 1.6;"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const leadModal = document.getElementById('leadModal');
    
    document.querySelectorAll('.view-lead-btn').forEach(btn => {
      btn.onclick = function() {
        const data = JSON.parse(this.getAttribute('data-lead'));
        
        document.getElementById('m-name').innerText = data.name;
        document.getElementById('m-date').innerText = "Submitted on " + data.created_at;
        document.getElementById('m-email').innerText = data.email;
        document.getElementById('m-phone').innerText = data.phone;
        document.getElementById('m-company').innerText = data.company || "N/A";
        document.getElementById('m-interest').innerText = data.interest;
        document.getElementById('m-state').innerText = data.state || "Unknown";
        document.getElementById('m-ip').innerText = data.ip_address || "N/A";
        document.getElementById('m-message').innerText = data.message || "No message provided.";
        
        const sourceBox = document.getElementById('m-source');
        if(data.source === 'popup_form') {
          sourceBox.innerHTML = '<span class="source-badge popup">Popup Form</span>';
        } else {
          sourceBox.innerHTML = '<span class="source-badge">Contact Page</span>';
        }
        
        leadModal.classList.add('active');
      };
    });

    function closeModal() {
      leadModal.classList.remove('active');
    }

    // Close on outside click
    window.onclick = function(event) {
      if (event.target == leadModal) closeModal();
    }

    const selectAll = document.getElementById('selectAll');
  const checks = document.querySelectorAll('.lead-item-check');
  const bulkActions = document.getElementById('bulkActions');

  function toggleBulk() {
    const anyChecked = Array.from(checks).some(c => c.checked);
    bulkActions.style.display = anyChecked ? 'block' : 'none';
  }

  if(selectAll) {
    selectAll.onchange = () => {
      checks.forEach(c => c.checked = selectAll.checked);
      toggleBulk();
    };
  }

  checks.forEach(c => {
    c.onchange = toggleBulk;
  });
</script>

<?php include_once 'includes/footer.php'; ?>
