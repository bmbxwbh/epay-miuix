<?php
if(!defined('IN_CRONLITE'))exit();
?>
</div><!-- /.mx-page -->
<footer class="mx-footer">
	<div class="mx-container">
		<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;">
			<div style="display:flex;gap:24px;flex-wrap:wrap;">
				<a href="/doc.html" class="mx-text-sm" style="color:var(--mx-text-tertiary)">开发文档</a>
				<a href="/?mod=agreement" class="mx-text-sm" style="color:var(--mx-text-tertiary)">服务条款</a>
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
</body>
</html>
