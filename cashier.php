<?php
$is_defend = true;
$nosession = true;
require './includes/common.php';

@header('Content-Type: text/html; charset=UTF-8');

$other=isset($_GET['other'])?true:false;
$trade_no=daddslashes($_GET['trade_no']);
$sitename=base64_decode(daddslashes($_GET['sitename']));
$row=$DB->getRow("SELECT * FROM pre_order WHERE trade_no='{$trade_no}' limit 1");
if(!$row)sysmsg('该订单号不存在，请返回来源地重新发起请求！');
if($row['status']==1)sysmsg('该订单已完成支付，请勿重复支付');
$gid = $DB->getColumn("SELECT gid FROM pre_user WHERE uid='{$row['uid']}' limit 1");
$paytype = \lib\Channel::getTypes($row['uid'], $gid);

if(checkwechat()){
	$paytype = array_values($paytype);
	foreach($paytype as $i=>$s){
		if($s['name']=='wxpay'){
			$temp = $paytype[$i];
			$paytype[$i] = $paytype[0];
			$paytype[0] = $temp;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>收银台 | <?php echo htmlspecialchars($sitename?$sitename:$conf['sitename'], ENT_QUOTES, 'UTF-8')?></title>
<link rel="stylesheet" href="/assets/css/miuix.css">
<style>
body { background: var(--mx-bg); }
.cashier-container { max-width: 480px; margin: 0 auto; padding: 20px; min-height: 100vh; }
.cashier-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 0; margin-bottom: 20px;
}
.cashier-header-title { font-size: 18px; font-weight: 600; }
.cashier-header-logo { font-size: 14px; color: var(--mx-text-tertiary); }
.cashier-amount-card {
  background: linear-gradient(135deg, var(--mx-accent) 0%, #5a9bff 100%);
  border-radius: var(--mx-radius-lg);
  padding: 32px 24px;
  color: #fff;
  text-align: center;
  margin-bottom: 20px;
}
.cashier-amount-label { font-size: 14px; opacity: 0.85; margin-bottom: 8px; }
.cashier-amount-value { font-size: 40px; font-weight: 700; letter-spacing: -0.02em; }
.cashier-amount-value::before { content: '¥'; font-size: 22px; font-weight: 500; vertical-align: super; margin-right: 2px; }
.cashier-order-info {
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius);
  padding: 16px 20px;
  margin-bottom: 20px;
  box-shadow: var(--mx-shadow);
  border: 1px solid var(--mx-border);
}
.cashier-info-row {
  display: flex; justify-content: space-between;
  padding: 8px 0; font-size: 14px;
  border-bottom: 1px solid var(--mx-border);
}
.cashier-info-row:last-child { border-bottom: none; }
.cashier-info-label { color: var(--mx-text-tertiary); }
.cashier-info-value { color: var(--mx-text-primary); font-weight: 500; }
.cashier-methods-title { font-size: 15px; font-weight: 600; margin-bottom: 12px; }
.cashier-methods { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 24px; }
.cashier-method {
  display: flex; align-items: center; gap: 12px;
  padding: 14px 16px;
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius-sm);
  border: 1.5px solid var(--mx-border);
  cursor: pointer;
  transition: all var(--mx-transition);
  box-shadow: var(--mx-shadow);
}
.cashier-method:hover, .cashier-method.active {
  border-color: var(--mx-accent);
  background: var(--mx-accent-light);
}
.cashier-method-icon {
  width: 32px; height: 32px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  background: var(--mx-bg-secondary);
}
.cashier-method-icon svg { width: 20px; height: 20px; }
.cashier-method-name { font-size: 14px; font-weight: 500; }
.cashier-pay-btn { margin-top: 8px; }
.cashier-pay-btn .mx-btn { font-size: 16px; padding: 14px; }
.cashier-footer { text-align: center; padding: 20px; font-size: 12px; color: var(--mx-text-tertiary); }
</style>
</head>
<body>
<div class="cashier-container">
  <div class="cashier-header">
    <div class="cashier-header-title">收银台</div>
    <div class="cashier-header-logo"><?php echo htmlspecialchars($sitename?$sitename:$conf['sitename'], ENT_QUOTES, 'UTF-8')?></div>
  </div>

  <?php if($other){?>
  <div class="mx-alert mx-alert-danger">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
    <div>当前支付方式暂时关闭维护，请更换其他方式支付。</div>
  </div>
  <?php } else {?>
  <!-- Amount -->
  <div class="cashier-amount-card">
    <div class="cashier-amount-label">需支付金额</div>
    <div class="cashier-amount-value"><?php echo $row['realmoney']?$row['realmoney']:$row['money']?></div>
  </div>

  <!-- Order Info -->
  <div class="cashier-order-info">
    <div class="cashier-info-row">
      <span class="cashier-info-label">商品名称</span>
      <span class="cashier-info-value"><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')?></span>
    </div>
    <div class="cashier-info-row">
      <span class="cashier-info-label">订单号</span>
      <span class="cashier-info-value" style="font-size:13px;"><?php echo htmlspecialchars($trade_no, ENT_QUOTES, 'UTF-8')?></span>
    </div>
    <div class="cashier-info-row">
      <span class="cashier-info-label">创建时间</span>
      <span class="cashier-info-value"><?php echo htmlspecialchars($row['addtime'], ENT_QUOTES, 'UTF-8')?></span>
    </div>
    <?php if($row['realmoney'] && $row['realmoney']!=$row['money']){?>
    <div class="cashier-info-row">
      <span class="cashier-info-label">手续费</span>
      <span class="cashier-info-value"><?php echo round($row['realmoney']-$row['money'],2)?> 元</span>
    </div>
    <?php }?>
  </div>
  <?php }?>

  <!-- Payment Methods -->
  <div class="cashier-methods-title">选择支付方式</div>
  <div class="cashier-methods">
    <?php
    $method_icons = [
      'wxpay' => '<svg viewBox="0 0 24 24" fill="#07C160" stroke="none"><circle cx="12" cy="12" r="10"/><path d="M8 13h8M12 9v8" stroke="#fff" stroke-width="2" fill="none"/></svg>',
      'alipay' => '<svg viewBox="0 0 24 24" fill="#1677FF" stroke="none"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8" stroke="#fff" stroke-width="2" fill="none"/></svg>',
      'qqpay' => '<svg viewBox="0 0 24 24" fill="#12B7F5" stroke="none"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8" stroke="#fff" stroke-width="2" fill="none"/></svg>',
      'bank' => '<svg viewBox="0 0 24 24" fill="#E60012" stroke="none"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8" stroke="#fff" stroke-width="2" fill="none"/></svg>',
    ];
    foreach($paytype as $i=>$rows){?>
    <div class="cashier-method <?php echo $i==0?'active':''?>" value="<?php echo $rows['id']?>">
      <div class="cashier-method-icon">
        <?php echo isset($method_icons[$rows['name']])?$method_icons[$rows['name']]:$method_icons['wxpay'];?>
      </div>
      <span class="cashier-method-name"><?php echo htmlspecialchars($rows['showname'], ENT_QUOTES, 'UTF-8')?></span>
    </div>
    <?php }?>
  </div>

  <!-- Pay Button -->
  <div class="cashier-pay-btn">
    <button class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" id="payBtn">
      立即支付
    </button>
  </div>

  <div class="cashier-footer"><?php echo htmlspecialchars($sitename?$sitename:$conf['sitename'], ENT_QUOTES, 'UTF-8')?></div>
</div>

<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('.cashier-method').click(function(){
    $('.cashier-method').removeClass('active');
    $(this).addClass('active');
  });
  $('#payBtn').click(function(){
    var value = $('.cashier-method.active').attr('value');
    var trade_no = '<?php echo htmlspecialchars($trade_no, ENT_QUOTES, 'UTF-8')?>';
    if(!value) { alert('请选择支付方式'); return; }
    window.location.href = './submit2.php?typeid=' + value + '&trade_no=' + trade_no;
  });
});
</script>
</body>
</html>
