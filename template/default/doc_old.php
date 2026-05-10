<?php
if(!defined('IN_CRONLITE'))exit();
require INDEX_ROOT.'head.php';
?>
<style>
body{color:var(--mx-text-primary);}
.mx-page-header { background: var(--mx-bg-card); border-bottom: 1px solid var(--mx-border); padding: 32px 24px; text-align: center; }
.mx-page-header h2 { font-size: 22px; font-weight: 700; color: var(--mx-text-primary); margin-bottom: 8px; }
.mx-content { max-width: 1000px; margin: 0 auto; padding: 32px 24px; }
.api_block{margin-bottom: 2em;}
</style>

<div class="mx-page-header">
<h2>开发文档</h2>
</div>

<div class="mx-content">

  <!-- Docs nav
  ================================================== -->
  <div class="row">
    <div class="col-md-3 ">
      <div id="toc" class="bc-sidebar">
		<ul class="nav">
			<hr/>
			<li class="toc-h2"><a href="#pay0">页面跳转支付</a></li>
      <li class="toc-h2"><a href="#pay1">API接口支付</a></li>
			<li class="toc-h2"><a href="#pay2">支付结果通知</a></li>
			<li class="toc-h2"><a href="#pay3">MD5签名算法</a></li>
      <li class="toc-h2"><a href="#pay4">支付方式列表</a></li>
      <li class="toc-h2"><a href="#pay5">设备类型列表</a></li>
			<hr/>
			<li class="toc-h2"><a href="#api1">[API]查询商户信息</a></li>
			<li class="toc-h2"><a href="#api3">[API]查询结算记录</a></li>
			<li class="toc-h2"><a href="#api4">[API]查询单个订单</a></li>
			<li class="toc-h2"><a href="#api5">[API]批量查询订单</a></li>
			<li class="toc-h2"><a href="#api6">[API]提交订单退款</a></li>
			<hr/>
			<li class="toc-h2"><a href="#sdk0">SDK下载</a></li>
			<hr/>
		</ul>
	</div>
   </div>

    <div class="col-md-9">
      <article class="post page">
      	<section class="post-content">
		<hr/>
<?php include INDEX_ROOT.'doc.inc.php';?>

          </section>
      </article>
    </div>
  </div>

</div>

<?php require INDEX_ROOT.'foot.php';?>