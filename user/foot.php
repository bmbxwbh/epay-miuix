<?php
// Close sidebar overlay on mobile
?>
</main><!-- /.mx-main -->
</div><!-- /.mx-layout -->
</div><!-- /.mx-page -->

<footer class="mx-footer" style="margin-left:240px;">
  <div class="mx-container">
    <span class="mx-text-xs" style="color:var(--mx-text-tertiary)">&copy; <?php echo date("Y")?> <?php echo $conf['sitename']?> &middot; Powered by Epay</span>
  </div>
</footer>

<!-- Sidebar overlay for mobile -->
<div class="mx-sidebar-overlay" id="sidebarOverlay" onclick="document.getElementById('sidebar').classList.remove('open');this.classList.remove('open');"></div>

<script src="../assets/js/mx-icons.js"></script>
<script>
// Mobile sidebar toggle
$('.mx-topbar-toggle').on('click', function(){
  $('#sidebar').toggleClass('open');
  $('#sidebarOverlay').toggleClass('open');
});
// Close sidebar on outside click (mobile)
$(document).on('click', function(e){
  if($(window).width() <= 768 && !$(e.target).closest('.mx-sidebar, .mx-topbar-toggle').length){
    $('#sidebar').removeClass('open');
    $('#sidebarOverlay').removeClass('open');
  }
});
</script>
</body>
</html>
