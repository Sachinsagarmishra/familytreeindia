</div> <!-- End admin-wrapper -->

<script>
  // Universal Toggle for Admin Sidebar
  const menuToggle = document.getElementById('menuToggle');
  const sidebar = document.getElementById('sidebar');

  if (menuToggle && sidebar) {
    menuToggle.onclick = (e) => {
      e.stopPropagation();
      sidebar.classList.toggle('active');
    };

    document.addEventListener('click', (e) => {
      if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && e.target !== menuToggle) {
        sidebar.classList.remove('active');
      }
    });
  }
</script>

</body>
</html>
