<?php
if(!defined('IN_CRONLITE'))exit();
?>
</div><!-- /.mx-page -->
<footer class="mx-footer">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));padding:0 0 24px;text-align:left;">
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:12px;color:var(--mx-text-primary);">关于我们</h4>
				<p style="margin-bottom:6px;"><a href="aboutUs.html" style="color:var(--mx-text-secondary);font-size:13px;">公司信息</a></p>
				<p style="margin-bottom:6px;"><a href="aboutUs.html" style="color:var(--mx-text-secondary);font-size:13px;">联系我们</a></p>
				<p style="margin-bottom:6px;"><a href="aboutUs.html" style="color:var(--mx-text-secondary);font-size:13px;">加入我们</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:12px;color:var(--mx-text-primary);">产品</h4>
				<p style="margin-bottom:6px;"><a href="/doc.html" style="color:var(--mx-text-secondary);font-size:13px;">开发文档</a></p>
				<p style="margin-bottom:6px;"><a href="/SDK.zip" style="color:var(--mx-text-secondary);font-size:13px;">SDK下载</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:12px;color:var(--mx-text-primary);">其它</h4>
				<p style="margin-bottom:6px;"><a href="aboutUs.html" style="color:var(--mx-text-secondary);font-size:13px;">合作伙伴</a></p>
				<p style="margin-bottom:6px;"><a href="agreement.html" style="color:var(--mx-text-secondary);font-size:13px;">用户协议</a></p>
				<p style="margin-bottom:6px;"><a href="produceIntroduce.html" style="color:var(--mx-text-secondary);font-size:13px;">功能介绍</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:12px;color:var(--mx-text-primary);">联系我们</h4>
				<p style="margin-bottom:6px;font-size:13px;color:var(--mx-text-secondary);">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
					QQ：<a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&Site=pay&Menu=yes" target="_blank"><?php echo $conf['kfqq']?></a>
				</p>
				<p style="margin-bottom:6px;font-size:13px;color:var(--mx-text-secondary);">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
					邮箱：<a href="mailto:<?php echo $conf['email']?>"><?php echo $conf['email']?></a>
				</p>
			</div>
		</div>
		<div class="mx-divider"></div>
		<p style="font-size:13px;color:var(--mx-text-tertiary);padding-top:16px;"><?php echo $conf['sitename']?>&nbsp;&nbsp;&copy;<?php echo date("Y")?>&nbsp;All Rights Reserved.&nbsp;&nbsp;<?php echo $conf['footer']?></p>
	</div>
</footer>
</body>
</html>
