<?php if($islogin==1){?>
</main><!-- /.mx-main -->
</div><!-- /.mx-layout -->
</div><!-- /.mx-page -->

<footer class="mx-footer" style="margin-left:240px;">
  <div class="mx-container">
    <span class="mx-text-xs" style="color:var(--mx-text-tertiary)">&copy; <?php echo date("Y")?> <?php echo $conf['sitename']??'支付管理中心'?> &middot; Powered by NAILTEAM</span>
  </div>
</footer>
<?php }?>

<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="../assets/js/mx-icons.js"></script>
<script>
// Mobile sidebar toggle
$('.mx-topbar-toggle').on('click', function(){
  $('#sidebar').toggleClass('open');
});
// Close sidebar on outside click (mobile)
$(document).on('click', function(e){
  if($(window).width() <= 768 && !$(e.target).closest('.mx-sidebar, .mx-topbar-toggle').length){
    $('#sidebar').removeClass('open');
  }
});
</script>
</body>
</html>
