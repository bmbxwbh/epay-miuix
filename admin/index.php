<?php
include("../includes/common.php");
$title='支付管理中心';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
if($conf['admin_pwd']==='123456'){
	$msg[]='<div class="mx-alert mx-alert-warning"><i class="fa fa-exclamation-triangle"></i> 及时修改网站默认管理员密码！</div>';
}elseif(strlen($conf['admin_pwd'])<6 || is_numeric($conf['admin_pwd']) && strlen($conf['admin_pwd'])<=10 || $conf['admin_pwd']===$conf['kfqq'] || $conf['admin_user']===$conf['admin_pwd']){
	$msg[]='<div class="mx-alert mx-alert-danger"><i class="fa fa-exclamation-triangle"></i> 网站管理员密码过于简单，请及时修改密码！</div>';
}
?>

<!-- Stats Cards -->
<div class="mx-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;margin-bottom:24px;">
  <div class="mx-card" style="padding:20px;">
    <div style="display:flex;align-items:center;gap:12px;">
      <div style="width:44px;height:44px;border-radius:var(--mx-radius);background:var(--mx-accent-light);color:var(--mx-accent);display:flex;align-items:center;justify-content:center;">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
      </div>
      <div>
        <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">订单总数</div>
        <div class="mx-font-bold" style="font-size:22px;" id="count1">-</div>
      </div>
    </div>
  </div>
  <div class="mx-card" style="padding:20px;">
    <div style="display:flex;align-items:center;gap:12px;">
      <div style="width:44px;height:44px;border-radius:var(--mx-radius);background:#e8f5e9;color:#43a047;display:flex;align-items:center;justify-content:center;">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
      </div>
      <div>
        <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">商户数量</div>
        <div class="mx-font-bold" style="font-size:22px;" id="count2">-</div>
      </div>
    </div>
  </div>
  <div class="mx-card" style="padding:20px;">
    <div style="display:flex;align-items:center;gap:12px;">
      <div style="width:44px;height:44px;border-radius:var(--mx-radius);background:#fff3e0;color:#ef6c00;display:flex;align-items:center;justify-content:center;">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
      </div>
      <div>
        <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">总计余额</div>
        <div class="mx-font-bold" style="font-size:22px;"><span id="usermoney">-</span> <span class="mx-text-xs" style="color:var(--mx-text-tertiary);font-weight:400;">元</span></div>
      </div>
    </div>
  </div>
  <div class="mx-card" style="padding:20px;">
    <div style="display:flex;align-items:center;gap:12px;">
      <div style="width:44px;height:44px;border-radius:var(--mx-radius);background:#e3f2fd;color:#1e88e5;display:flex;align-items:center;justify-content:center;">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <div>
        <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">结算总额</div>
        <div class="mx-font-bold" style="font-size:22px;"><span id="settlemoney">-</span> <span class="mx-text-xs" style="color:var(--mx-text-tertiary);font-weight:400;">元</span></div>
      </div>
    </div>
  </div>
  <div class="mx-card" style="padding:20px;">
    <div style="display:flex;align-items:center;gap:12px;">
      <div style="width:44px;height:44px;border-radius:var(--mx-radius);background:#fce4ec;color:#e53935;display:flex;align-items:center;justify-content:center;">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
      </div>
      <div>
        <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">今日成功率</div>
        <div class="mx-font-bold" style="font-size:22px;"><span id="success_rate">-</span><span class="mx-text-xs" style="color:var(--mx-text-tertiary);font-weight:400;">%</span></div>
      </div>
    </div>
  </div>
  <div class="mx-card" style="padding:20px;">
    <div style="display:flex;align-items:center;gap:12px;">
      <div style="width:44px;height:44px;border-radius:var(--mx-radius);background:#f3e5f5;color:#8e24aa;display:flex;align-items:center;justify-content:center;">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
      <div>
        <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">当前时间</div>
        <div class="mx-font-bold" style="font-size:15px;"><?=$date?></div>
      </div>
    </div>
  </div>
</div>

<?php if($msg){foreach($msg as $x){echo $x;}}?>

<!-- Admin Info + Browser Notice -->
<div style="display:grid;grid-template-columns:1fr 300px;gap:16px;margin-bottom:24px;">
  <div>
    <div id="browser-notice"></div>
  </div>
  <div class="mx-card" style="padding:20px;text-align:center;">
    <img src="<?php echo ($conf['kfqq'])?'//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$conf['kfqq'].'&src_uin='.$conf['kfqq'].'&fid='.$conf['kfqq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'../assets/img/user.png'?>" alt="avatar" style="width:64px;height:64px;border-radius:50%;object-fit:cover;margin-bottom:12px;border:2px solid var(--mx-border);">
    <div class="mx-font-bold" style="margin-bottom:4px;"><?php echo $conf['admin_user']?></div>
    <div class="mx-text-xs" style="color:var(--mx-accent);margin-bottom:12px;">管理员</div>
    <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;">
      <a href="../" class="mx-btn mx-btn-ghost mx-btn-sm">返回首页</a>
      <a href="./set.php?mod=account" class="mx-btn mx-btn-secondary mx-btn-sm">修改密码</a>
      <a href="./login.php?logout" class="mx-btn mx-btn-ghost mx-btn-sm" style="color:var(--mx-danger)">退出登录</a>
    </div>
  </div>
</div>

<!-- Payment Type Stats -->
<div class="mx-card" style="margin-bottom:16px;">
  <div style="padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--mx-border);">
    <div class="mx-font-bold">支付方式收入统计 <span class="mx-text-xs" style="color:var(--mx-text-tertiary);font-weight:400;">（1小时更新一次）</span></div>
    <button onclick="getData(true)" class="mx-btn mx-btn-ghost mx-btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
  </div>
  <div class="table-responsive" style="padding:0;">
    <table class="table table-bordered table-striped" style="margin:0;">
      <thead><tr id="paytype_head"><th>日期</th></tr></thead>
      <tbody id="paytype_list"></tbody>
    </table>
  </div>
</div>

<!-- Channel Stats -->
<div class="mx-card" style="margin-bottom:16px;">
  <div style="padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--mx-border);">
    <div class="mx-font-bold">支付通道收入统计 <span class="mx-text-xs" style="color:var(--mx-text-tertiary);font-weight:400;">（1小时更新一次）</span></div>
    <button onclick="getData(true)" class="mx-btn mx-btn-ghost mx-btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
  </div>
  <div class="table-responsive" style="padding:0;">
    <table class="table table-bordered table-striped" style="margin:0;">
      <thead><tr id="channel_head"><th>日期</th></tr></thead>
      <tbody id="channel_list"></tbody>
    </table>
  </div>
</div>

<!-- Profit Stats -->
<div class="mx-card" style="margin-bottom:16px;">
  <div style="padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--mx-border);">
    <div class="mx-font-bold">支付方式手续费利润 <span class="mx-text-xs" style="color:var(--mx-text-tertiary);font-weight:400;">（已扣除通道成本，1小时更新一次）</span></div>
    <button onclick="getData(true)" class="mx-btn mx-btn-ghost mx-btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
  </div>
  <div class="table-responsive" style="padding:0;">
    <table class="table table-bordered table-striped" style="margin:0;">
      <thead><tr id="profit_paytype_head"><th>日期</th></tr></thead>
      <tbody id="profit_paytype_list"></tbody>
    </table>
  </div>
</div>

<script>
$(document).ready(function(){
	getData();
});
function getData(getnew){
	getnew = getnew || false;
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getcount"+(getnew?'&getnew=1':''),
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#count1').html(data.count1);
			$('#count2').html(data.count2);
			$('#usermoney').html(data.usermoney);
			$('#settlemoney').html(data.settlemoney);
			$('#success_rate').html(data.success_rate);

			$("#paytype_head").html('<th>日期</th>');
			$("#paytype_list").empty();
			var paytype=new Array();
			$.each(data.paytype, function(k, v){
				paytype.push(k);
				$("#paytype_head").append('<th>'+v+'</th>');
			});
			$("#paytype_head").append('<th>总计</th>');
			var order = '';
			$.each(paytype, function(k, v){
				if(typeof data.order_today.paytype[v] != "undefined")order+='<td>'+data.order_today.paytype[v]+'</td>';
				else order+='<td>0</td>';
			});
			$("#paytype_list").append('<tr><td>今日</td>'+order+'<td>'+data.order_today.all+'</td></tr>');
			$.each(data.order, function(k, v){
				var order = '';
				$.each(paytype, function(key, value){
					if(typeof v.paytype[value] != "undefined")order+='<td>'+v.paytype[value]+'</td>';
					else order+='<td>0</td>';
				});
				$("#paytype_list").append('<tr><td>'+k+'</td>'+order+'<td>'+v.all+'</td></tr>');
			});

			$("#channel_head").html('<th>日期</th>');
			$("#channel_list").empty();
			var channel=new Array();
			$.each(data.channel, function(k, v){
				channel.push(k);
				$("#channel_head").append('<th>'+v+'</th>');
			});
			$("#channel_head").append('<th>总计</th>');
			var order = '';
			$.each(channel, function(k, v){
				if(typeof data.order_today.channel[v] != "undefined")order+='<td>'+data.order_today.channel[v]+'</td>';
				else order+='<td>0</td>';
			});
			$("#channel_list").append('<tr><td>今日</td>'+order+'<td>'+data.order_today.all+'</td></tr>');
			$.each(data.order, function(k, v){
				var order = '';
				$.each(channel, function(key, value){
					if(typeof v.channel[value] != "undefined")order+='<td>'+v.channel[value]+'</td>';
					else order+='<td>0</td>';
				});
				$("#channel_list").append('<tr><td>'+k+'</td>'+order+'<td>'+v.all+'</td></tr>');
			});

			$("#profit_paytype_head").html('<th>日期</th>');
			$("#profit_paytype_list").empty();
			var paytype=new Array();
			$.each(data.paytype, function(k, v){
				paytype.push(k);
				$("#profit_paytype_head").append('<th>'+v+'</th>');
			});
			$("#profit_paytype_head").append('<th>总计</th>');
			var order = '';
			$.each(paytype, function(k, v){
				if(typeof data.order_today.profit_paytype[v] != "undefined")order+='<td>'+data.order_today.profit_paytype[v]+'</td>';
				else order+='<td>0</td>';
			});
			$("#profit_paytype_list").append('<tr><td>今日</td>'+order+'<td>'+data.order_today.profit_all+'</td></tr>');
			$.each(data.order, function(k, v){
				var order = '';
				$.each(paytype, function(key, value){
					if(typeof v.profit_paytype[value] != "undefined")order+='<td>'+v.profit_paytype[value]+'</td>';
					else order+='<td>0</td>';
				});
				$("#profit_paytype_list").append('<tr><td>'+k+'</td>'+order+'<td>'+v.profit_all+'</td></tr>');
			});
		}
	});
}
</script>
<script>
function speedModeNotice(){
	var ua = window.navigator.userAgent;
	if(ua.indexOf('Windows NT')>-1 && ua.indexOf('Trident/')>-1){
		var html = "<div class=\"mx-alert mx-alert-warning\">当前浏览器是兼容模式，为确保后台功能正常使用，请切换到<b style='color:#51b72f'>极速模式</b>！<br>操作方法：点击浏览器地址栏右侧的IE符号→选择\"极速模式\"</div>";
		$("#browser-notice").html(html)
	}
}
speedModeNotice();
</script>

<?php include './foot.php';?>
