<?php if(!defined('IN_CRONLITE'))exit();?>
</div><!-- /.mx-page -->

<footer class="mx-footer">
  <div class="mx-container">
    <div class="mx-flex mx-justify-between mx-items-center" style="flex-wrap:wrap;gap:16px;">
      <div class="mx-flex mx-gap-24" style="flex-wrap:wrap;">
        <a href="/?mod=agreement" class="mx-text-sm" style="color:var(--mx-text-tertiary)">服务条款</a>
        <a href="/?mod=doc" class="mx-text-sm" style="color:var(--mx-text-tertiary)">开发文档</a>
        <?php if(!empty($conf['kfqq'])){?>
        <a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&Site=pay&Menu=yes" target="_blank" class="mx-text-sm" style="color:var(--mx-text-tertiary)">联系客服</a>
        <?php }?>
      </div>
      <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">
        &copy; <?php echo date("Y")?> <?php echo $conf['sitename']?>. <?php echo $conf['footer']?>
      </div>
    </div>
  </div>
</footer>

<script src="<?php echo STATIC_ROOT?>js/mx-icons.js"></script>
<script>
// Mobile menu toggle
document.querySelector('.mx-topbar-toggle')?.addEventListener('click', function(){
  document.querySelector('.mx-topbar-nav').classList.toggle('open');
});
</script>
</body>
</html>
