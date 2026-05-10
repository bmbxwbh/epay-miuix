<?php
$is_defend = true;
include("./inc.php");
if(isset($_GET['ucode'])){
	$code=trim($_GET['ucode']);
    if(!preg_match('/^[a-zA-Z0-9]{1,32}$/',$code)) showerror('参数错误');
    $uid = $DB->findColumn('onecode', 'uid', ['code' => $code]);
    if(!$uid) showerror('当前码牌未绑定商户<br/>码牌编号：'.$code.'<br/><div style="margin-top:16px"><a href="/user/onecode.php?bind='.$code.'" class="mx-btn mx-btn-primary">点此绑定</a></div>');
}elseif(isset($_GET['merchant'])){
	$merchant=trim($_GET['merchant']);
	$uid = authcode($merchant, 'DECODE', SYS_KEY);
	if(!$uid || !is_numeric($uid))showerror('参数错误');
}elseif(isset($_SESSION['paypage_uid'])){
	$uid = intval($_SESSION['paypage_uid']);
}else{
	showerror('参数不完整');
}
$userrow = $DB->getRow("SELECT `uid`,`gid`,`money`,`mode`,`pay`,`cert`,`status`,`username`,`channelinfo`,`qq`,`codename`,`deposit` FROM `pre_user` WHERE `uid`='{$uid}' LIMIT 1");
if(!$userrow || $userrow['status']==0 || $userrow['pay']==0)showerror('当前商户不存在或已被封禁');
if($userrow['pay']==2 && $conf['user_review']==1)showerror('商户没通过审核，请联系官方客服进行审核');
$groupconfig = getGroupConfig($userrow['gid']);
$conf = array_merge($conf, $groupconfig);
if($conf['cert_force']==1 && $userrow['cert']==0){
	showerror('当前商户未完成实名认证，无法收款');
}
if($conf['forceqq']==1 && empty($userrow['qq'])){
	showerror('当前商户未填写联系QQ，无法收款');
}
if($conf['user_deposit']==1 && $conf['user_deposit_min'] > 0 && $conf['user_deposit_min'] > $userrow['deposit']){
    showerror('商户保证金不足，请前往支付平台充值保证金后再发起支付');
}
if(!empty($conf['pay_region_block'])){
    $ipregion = get_ip_region($clientip);
    if($ipregion){
        foreach(explode('|',$conf['pay_region_block']) as $rows){
            if(strpos($ipregion, $rows) !== false){
                showerror('您所在的地区无法发起支付，请更换其他支付方式');
            }
        }
    }
}

$_SESSION['paypage_uid'] = $uid;

$direct = '0';
$checktype = check_paytype();
$type = isset($_GET['type'])?trim($_GET['type']):$checktype;
if($type){
    if((isset($_GET['code']) || isset($_GET['auth_code']) || isset($_GET['userAuthCode'])) && $_SESSION['paypage_channel']){
        $submitData = \lib\Channel::info($_SESSION['paypage_channel'], $userrow['gid']);
        if($_SESSION['paypage_subchannel'] > 0) $submitData['subchannel'] = $_SESSION['paypage_subchannel'];
    }else{
        $submitData = \lib\Channel::submit($type, $uid, $userrow['gid']);
        $_SESSION['paypage_subchannel'] = $submitData['subchannel'];
    }
    $_SESSION['paypage_typeid'] = $submitData['typeid'];
	$_SESSION['paypage_channel'] = $submitData['channel'];
	$_SESSION['paypage_rate'] = $submitData['rate'];
	$_SESSION['paypage_paymax'] = $submitData['paymax'];
	$_SESSION['paypage_paymin'] = $submitData['paymin'];
    $_SESSION['paypage_mode'] = $submitData['mode'];

    $channel = $submitData['subchannel'] > 0 ? \lib\Channel::getSub($submitData['subchannel']) : \lib\Channel::get($submitData['channel'], $userrow['channelinfo']);
    if(!$channel)showerror('支付通道不存在');

	$apptype = explode(',',$channel['apptype']);
	if($checktype == 'alipay' && $type == 'alipay' && (
        ($submitData['plugin']=='alipay' || $submitData['plugin']=='alipaysl' || $submitData['plugin']=='alipayd') && in_array('4',$apptype)
        || $submitData['plugin']=='lakala' && in_array('2',$apptype)
        || $submitData['plugin']=='huifu' && in_array('4',$apptype)
        || $submitData['plugin']=='xsy' && in_array('2',$apptype)
        || $submitData['plugin']=='baofu' && in_array('2',$apptype)
        || $submitData['plugin']=='adapay' && in_array('2',$apptype)
        || $submitData['plugin']=='allinpay' && in_array('2',$apptype)
        || $submitData['plugin']=='dinpay' && in_array('3',$apptype)
        || $submitData['plugin']=='duolabao' && in_array('2',$apptype)
        || $submitData['plugin']=='fubei'
        || $submitData['plugin']=='fuiou2' && in_array('2',$apptype)
        || $submitData['plugin']=='haipay' && in_array('2',$apptype)
        || $submitData['plugin']=='hlpay' && in_array('2',$apptype)
        || $submitData['plugin']=='huishouqian' && in_array('2',$apptype)
        || $submitData['plugin']=='jindd' && in_array('2',$apptype)
        || $submitData['plugin']=='jlpay' && in_array('2',$apptype)
        || $submitData['plugin']=='joinpay' && in_array('3',$apptype)
        || $submitData['plugin']=='leshua' && in_array('2',$apptype)
        || $submitData['plugin']=='llianpay' && in_array('2',$apptype)
        || $submitData['plugin']=='sandpay' && in_array('2',$apptype)
        || $submitData['plugin']=='shengpay' && in_array('4',$apptype)
        || $submitData['plugin']=='suixingpay' && in_array('2',$apptype)
        || $submitData['plugin']=='unionpay' && in_array('2',$apptype)
        || $submitData['plugin']=='ysepay' && in_array('3',$apptype)
        || $submitData['plugin']=='yseqt' && in_array('2',$apptype)
        || $submitData['plugin']=='yeepay' && in_array('2',$apptype)
        )){
        if($conf['alipay_web_login_all'] == 1 && $conf['alipay_web_login'] > 0 || $submitData['plugin']!='alipay' && $submitData['plugin']!='alipaysl' && $submitData['plugin']!='alipayd'){
            if(!$conf['alipay_web_login']) showerror('未配置支付宝网页快捷登录通道');
            $channel = \lib\Channel::get($conf['alipay_web_login']);
        }
        $openId = alipayOpenId($channel);
		$direct = '1';
	}elseif($checktype == 'wxpay' && $type == 'wxpay' && $channel['appwxmp']>0 && (
        ($submitData['plugin']=='wxpay' || $submitData['plugin']=='wxpaysl' || $submitData['plugin']=='wxpayn' || $submitData['plugin']=='wxpaynp') && in_array('2',$apptype)
        || $submitData['plugin']=='lakala'
        || $submitData['plugin']=='huifu' && in_array('1',$apptype)
        || $submitData['plugin']=='xsy'
        || $submitData['plugin']=='baofu' && in_array('2',$apptype)
        || $submitData['plugin']=='adapay' && in_array('1',$apptype)
        || $submitData['plugin']=='allinpay' && in_array('2',$apptype)
        || $submitData['plugin']=='dinpay' && in_array('3',$apptype)
        || $submitData['plugin']=='duolabao' && in_array('2',$apptype)
        || $submitData['plugin']=='fubei'
        || $submitData['plugin']=='fuiou2' && in_array('2',$apptype)
        || $submitData['plugin']=='haipay'
        || $submitData['plugin']=='hlpay' && in_array('2',$apptype)
        || $submitData['plugin']=='huishouqian' && in_array('2',$apptype)
        || $submitData['plugin']=='jindd' && in_array('1',$apptype)
        || $submitData['plugin']=='jlpay' && in_array('2',$apptype)
        || $submitData['plugin']=='joinpay' && in_array('3',$apptype)
        || $submitData['plugin']=='leshua' && in_array('2',$apptype)
        || $submitData['plugin']=='llianpay' && in_array('2',$apptype)
        || $submitData['plugin']=='passpay' && in_array('2',$apptype)
        || $submitData['plugin']=='sandpay' && in_array('2',$apptype)
        || $submitData['plugin']=='shengpay' && in_array('1',$apptype)
        || $submitData['plugin']=='suixingpay' && in_array('2',$apptype)
        || $submitData['plugin']=='unionpay' && in_array('2',$apptype)
        || $submitData['plugin']=='ysepay' && in_array('2',$apptype)
        || $submitData['plugin']=='yseqt' && in_array('3',$apptype)
        || $submitData['plugin']=='yeepay' && in_array('2',$apptype)
        )){
		$openId = weixinOpenId($channel);
		$direct = '1';
	}elseif($checktype == 'bank' && $type == 'bank' && (
        $submitData['plugin']=='lakala' && in_array('2',$apptype)
        || $submitData['plugin']=='huifu' && in_array('4',$apptype)
        || $submitData['plugin']=='xsy' && in_array('2',$apptype)
        || $submitData['plugin']=='baofu' && in_array('2',$apptype)
        || $submitData['plugin']=='allinpay' && in_array('2',$apptype)
        || $submitData['plugin']=='jlpay' && in_array('2',$apptype)
        || $submitData['plugin']=='yseqt' && in_array('2',$apptype)
        )){
        $openId = unionpayOpenId($channel);
		$direct = '1';
	}elseif($checktype == 'qqpay' && $type == 'qqpay' && $submitData['plugin']=='qqpay' && in_array('2',$apptype)){
		$direct = '1';
	}
}

$money = isset($_GET['money'])?$_GET['money']:null;
if($money<=0 || !is_numeric($money) || !preg_match('/^[0-9.]+$/', $money))$money = null;
$codename = !empty($userrow['codename'])?$userrow['codename']:$userrow['username'];
$csrf_token = md5(mt_rand(0,999).time());
$_SESSION['paypage_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<title>向商户付款</title>
<link rel="stylesheet" href="../assets/css/miuix.css">
<style>
body { background: var(--mx-bg); }
.pay-layout {
  max-width: 480px;
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.pay-merchant {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 24px 24px 0;
}
.pay-merchant-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--mx-accent-light);
  color: var(--mx-accent);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  font-weight: 700;
}
.pay-merchant-name {
  font-size: 18px;
  font-weight: 600;
}
.pay-amount-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 40px 24px;
}
.pay-amount-label {
  font-size: 14px;
  color: var(--mx-text-tertiary);
  margin-bottom: 16px;
}
.pay-amount-display {
  display: flex;
  align-items: baseline;
  gap: 4px;
  min-height: 60px;
}
.pay-currency {
  font-size: 28px;
  font-weight: 600;
  color: var(--mx-text-primary);
}
.pay-amount-value {
  font-size: 48px;
  font-weight: 700;
  color: var(--mx-text-primary);
  letter-spacing: -0.02em;
  line-height: 1;
  min-width: 4px;
}
.pay-cursor {
  width: 2px;
  height: 48px;
  background: var(--mx-accent);
  animation: blink 1s step-end infinite;
}
@keyframes blink { 50% { opacity: 0; } }
.pay-amount-line {
  height: 2px;
  background: var(--mx-border);
  margin-top: 8px;
  position: relative;
}
.pay-amount-line::after {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 0;
  background: var(--mx-accent);
  transition: width 0.3s;
}
.pay-remark {
  padding: 0 24px 16px;
}
.pay-remark-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 0;
  font-size: 14px;
  color: var(--mx-text-secondary);
}
.pay-remark-row a {
  color: var(--mx-accent);
  font-size: 13px;
}
/* Keyboard */
.pay-keyboard {
  margin-top: auto;
  background: var(--mx-bg-secondary);
  padding: 8px;
  border-top: 1px solid var(--mx-border);
}
.pay-keyboard table {
  width: 100%;
  border-spacing: 6px;
}
.pay-keyboard td {
  height: 52px;
  text-align: center;
  font-size: 22px;
  font-weight: 500;
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius-sm);
  cursor: pointer;
  transition: all 0.1s;
  user-select: none;
  -webkit-tap-highlight-color: transparent;
}
.pay-keyboard td:active {
  background: var(--mx-bg-tertiary);
  transform: scale(0.96);
}
.pay-key-delete {
  background: var(--mx-bg-tertiary) !important;
}
.pay-key-delete svg { width: 24px; height: 24px; color: var(--mx-text-secondary); }
.pay-key-submit {
  background: var(--mx-accent) !important;
  color: #fff !important;
  font-size: 16px !important;
  font-weight: 600 !important;
  border-radius: var(--mx-radius) !important;
}
.pay-key-submit:active { background: var(--mx-accent-hover) !important; }
.pay-footer {
  text-align: center;
  padding: 12px;
  font-size: 12px;
  color: var(--mx-text-tertiary);
}
/* Remark Modal */
.pay-modal-mask {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.4);
  backdrop-filter: blur(4px);
  display: none;
  align-items: flex-end;
  justify-content: center;
  z-index: 100;
}
.pay-modal-mask.show { display: flex; }
.pay-modal {
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius-lg) var(--mx-radius-lg) 0 0;
  width: 100%;
  max-width: 480px;
  padding: 24px;
  animation: slideUp 0.3s ease;
}
@keyframes slideUp { from { transform: translateY(100%); } to { transform: translateY(0); } }
.pay-modal-title {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.pay-modal-close {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--mx-bg-secondary);
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}
.pay-modal textarea {
  width: 100%;
  border: 1.5px solid var(--mx-border);
  border-radius: var(--mx-radius-sm);
  padding: 12px;
  font-size: 14px;
  resize: none;
  outline: none;
  font-family: inherit;
  background: var(--mx-bg-secondary);
  color: var(--mx-text-primary);
}
.pay-modal textarea:focus { border-color: var(--mx-accent); }
.pay-modal-tip { font-size: 12px; color: var(--mx-danger); display: none; margin-top: 8px; }
</style>
</head>
<body>
<div class="pay-layout">
  <!-- Merchant Info -->
  <div class="pay-merchant">
    <div class="pay-merchant-avatar"><?php echo strtoupper(substr(htmlspecialchars($codename, ENT_QUOTES, 'UTF-8'),0,1))?></div>
    <div>
      <div class="pay-merchant-name"><?php echo htmlspecialchars($codename, ENT_QUOTES, 'UTF-8')?></div>
      <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">向该商户付款</div>
    </div>
  </div>

  <!-- Amount Input -->
  <div class="pay-amount-section">
    <form name="payForm" action="dopay" method="post">
      <input type="hidden" name="uid" value="<?php echo $uid?>">
      <input type="hidden" name="token" value="<?php echo $csrf_token?>">
      <input type="hidden" name="paytype" id="paytype" value="<?php echo $type?>">
      <input type="hidden" name="direct" value="<?php echo $direct?>">
      <input type="hidden" name="payer" value="<?php echo $openId?>">
      <input type="hidden" name="trade_no" value="">
      <?php if($money){?><input type="hidden" name="txAmount" id="txAmount" value="<?php echo $money?>"><?php }?>
    </form>
    <div class="pay-amount-label">请输入付款金额</div>
    <div class="pay-amount-display">
      <span class="pay-currency">¥</span>
      <span class="pay-amount-value" id="amount"></span>
      <span class="pay-cursor" id="cursor"></span>
    </div>
    <div class="pay-amount-line"></div>
  </div>

  <!-- Remark -->
  <div class="pay-remark">
    <div class="pay-remark-row">
      <span>备注：<span id="remark-content"></span></span>
      <div id="remark-actions">
        <a href="#" id="openModal">添加备注</a>
        <a href="#" id="editRemark" style="display:none">编辑</a>
        <a href="#" id="clearRemark" style="display:none;margin-left:8px">清除</a>
      </div>
    </div>
  </div>

  <!-- Keyboard -->
  <div class="pay-keyboard">
    <table id="keyboard">
      <tr>
        <td data-value="1">1</td>
        <td data-value="2">2</td>
        <td data-value="3">3</td>
        <td class="pay-key-delete" data-value="delete">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 002-2V6a2 2 0 00-2-2z"/><line x1="18" y1="9" x2="12" y2="15"/><line x1="12" y1="9" x2="18" y2="15"/></svg>
        </td>
      </tr>
      <tr>
        <td data-value="4">4</td>
        <td data-value="5">5</td>
        <td data-value="6">6</td>
        <td class="pay-key-submit" rowspan="3" id="payBtn">确认<br>支付</td>
      </tr>
      <tr>
        <td data-value="7">7</td>
        <td data-value="8">8</td>
        <td data-value="9">9</td>
      </tr>
      <tr>
        <td colspan="2" data-value="0">0</td>
        <td data-value="dot">.</td>
      </tr>
    </table>
  </div>

  <div class="pay-footer">由 <strong><?php echo $conf['sitename']?></strong> 提供服务支持</div>
</div>

<!-- Remark Modal -->
<div class="pay-modal-mask" id="remarkModal">
  <div class="pay-modal">
    <div class="pay-modal-title">
      <span id="modalTitle">添加备注</span>
      <button class="pay-modal-close" id="modalClose">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <textarea id="remarkInput" placeholder="请输入备注内容，30个字以内" rows="3"></textarea>
    <div class="pay-modal-tip" id="remarkTip">备注内容不能超过30个字</div>
    <button class="mx-btn mx-btn-primary mx-btn-block" style="margin-top:16px" id="remarkSubmit">确认</button>
  </div>
</div>

<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script src="//open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
<script src="js/hammer.js"></script>
<script src="js/common.js"></script>
<script src="js/pay.js?v=1005"></script>
<script>
document.body.addEventListener('touchmove', function(e){ e.preventDefault(); }, {passive: false});

// Remark modal
var modal = document.getElementById('remarkModal');
document.getElementById('openModal').onclick = function(e){
  e.preventDefault();
  document.getElementById('modalTitle').textContent = '添加备注';
  modal.classList.add('show');
};
document.getElementById('editRemark').onclick = function(e){
  e.preventDefault();
  document.getElementById('modalTitle').textContent = '编辑备注';
  modal.classList.add('show');
};
document.getElementById('modalClose').onclick = function(){
  modal.classList.remove('show');
};
document.getElementById('remarkSubmit').onclick = function(){
  var val = document.getElementById('remarkInput').value;
  if(val.length > 30){
    document.getElementById('remarkTip').style.display = 'block';
    return;
  }
  document.getElementById('remark-content').textContent = val;
  modal.classList.remove('show');
  if(val.length > 0){
    document.getElementById('editRemark').style.display = '';
    document.getElementById('clearRemark').style.display = '';
    document.getElementById('openModal').style.display = 'none';
  }
};
document.getElementById('clearRemark').onclick = function(e){
  e.preventDefault();
  document.getElementById('remark-content').textContent = '';
  document.getElementById('remarkInput').value = '';
  document.getElementById('openModal').style.display = '';
  document.getElementById('editRemark').style.display = 'none';
  this.style.display = 'none';
};
</script>
</body>
</html>
