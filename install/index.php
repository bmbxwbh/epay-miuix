<?php
//程序安装文件
error_reporting(0);
date_default_timezone_set("PRC");
$databaseFile = '../config.php';

@header('Content-Type: text/html; charset=UTF-8');
$step=isset($_GET['step'])?$_GET['step']:1;
if(file_exists('install.lock')){
    exit('<!DOCTYPE html><html lang="zh-CN"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>已安装</title><link rel="stylesheet" href="/assets/css/miuix.css"><style>body{background:var(--mx-bg);display:flex;align-items:center;justify-content:center;min-height:100vh;padding:20px}.c{max-width:400px;text-align:center;background:var(--mx-bg-card);border-radius:var(--mx-radius-lg);padding:40px 24px;box-shadow:var(--mx-shadow-md);border:1px solid var(--mx-border)}.c svg{width:48px;height:48px;color:var(--mx-success);margin-bottom:16px}.c h2{font-size:18px;font-weight:600;margin-bottom:8px}.c p{font-size:14px;color:var(--mx-text-secondary)}</style></head><body><div class="c"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m8 12.5 2.5 3 5.5-6"/></svg><h2>已成功安装</h2><p>如需重新安装，请手动删除 install 目录下 install.lock 文件</p></div></body></html>');
}

function clearpack() {
	$array=glob('../epay_release*');
	foreach($array as $dir){ unlink($dir); }
	$array=glob('../epay_update*');
	foreach($array as $dir){ unlink($dir); }
}

function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) { $hash .= $seed[mt_rand(0, $max)]; }
	return $hash;
}

if($step==3){
    if($_GET['jump']==1){
        include '../config.php';
        if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
            $errorMsg='请先填写好数据库并保存后再安装！';
        }
    }else{
        $host=isset($_POST['host'])?$_POST['host']:null;
        $port=isset($_POST['port'])?$_POST['port']:null;
        $user=isset($_POST['user'])?$_POST['user']:null;
        $pwd=isset($_POST['pwd'])?$_POST['pwd']:null;
        $database=isset($_POST['database'])?$_POST['database']:null;
        $dbqz=isset($_POST['dbqz'])?$_POST['dbqz']:null;
        if(empty($host)||empty($port)||empty($user)||empty($pwd)||empty($database)||empty($dbqz)){
            $errorMsg='请填写完整所有数据库信息！';
        }
        $dbconfig=array('host'=>$host,'port'=>$port,'user'=>$user,'pwd'=>$pwd,'dbname'=>$database,'dbqz'=>$dbqz);
        $config="<?php\n    /*数据库配置*/\n    \$dbconfig=array(\n        'host' => '{$host}',\n        'port' => {$port},\n        'user' => '{$user}',\n        'pwd' => '{$pwd}',\n        'dbname' => '{$database}',\n        'dbqz' => '{$dbqz}'\n    );\n    ";
    }
    if(empty($errorMsg)){
        try{
            $DB=new PDO("mysql:host=".$dbconfig['host'].";dbname=".$dbconfig['dbname'].";port=".$dbconfig['port'],$dbconfig['user'],$dbconfig['pwd']);
        }catch(Exception $e){
            if($e->getCode()==2002) $errorMsg='连接数据库失败：数据库地址填写错误！';
            elseif($e->getCode()==1045) $errorMsg='连接数据库失败：数据库用户名或密码填写错误！';
            elseif($e->getCode()==1049) $errorMsg='连接数据库失败：数据库名不存在！';
            else $errorMsg='连接数据库失败：'.$e->getMessage();
        }
        if(empty($errorMsg)){
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            $DB->exec("set sql_mode = ''");
            $DB->exec("set names utf8");
            $mysqlversion = $DB->query("select version()")->fetchColumn();
            if(version_compare($mysqlversion, '5.5.3', '<')){
                $errorMsg='MySQL数据库版本太低，需要MySQL 5.6或以上版本！';
            }
            if(!$_GET['jump'] && !file_put_contents($databaseFile, $config)){
                $errorMsg='保存失败，请确保网站根目录有写入权限';
            }
        }
    }
}elseif($step==4){
    include '../config.php';
    if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']){
        $errorMsg='请先填写好数据库并保存后再安装！';
    }else{
        try{
            $DB=new PDO("mysql:host=".$dbconfig['host'].";dbname=".$dbconfig['dbname'].";port=".$dbconfig['port'],$dbconfig['user'],$dbconfig['pwd']);
        }catch(Exception $e){
            $errorMsg='连接数据库失败：'.$e->getMessage();
        }
        if(empty($errorMsg) && !$_GET['jump']){
            $dbqz = $dbconfig['dbqz'];
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            $DB->exec("set sql_mode = ''");
            $DB->exec("set names utf8");
            $sqls=file_get_contents('install.sql');
            $sqls=explode(';', $sqls);
            $sqls[]="INSERT INTO `".$dbqz."_config` VALUES ('syskey', '".random(32)."')";
            $sqls[]="INSERT INTO `".$dbqz."_config` VALUES ('build', '".date("Y-m-d")."')";
            $sqls[]="INSERT INTO `".$dbqz."_config` VALUES ('cronkey', '".rand(111111,999999)."')";
            $success=0;$error=0;$errorMsg=null;
            foreach ($sqls as $value) {
                $value=trim($value);
                if(empty($value))continue;
                $value = str_replace('pre_',$dbqz.'_',$value);
                if($DB->exec($value)===false){
                    $error++;
                    $dberror=$DB->errorInfo();
                    $errorMsg.=$dberror[2]."<br>";
                }else{ $success++; }
            }
        }
        if(empty($errorMsg)){
            $lock_status = file_put_contents("install.lock",'安装锁');
            clearpack();
            $step = 5;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>彩虹易支付 - 安装程序</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .install-card { max-width: 520px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .install-header { padding: 32px 24px 24px; text-align: center; border-bottom: 1px solid var(--mx-border); }
        .install-header h1 { font-size: 22px; font-weight: 700; color: var(--mx-text-primary); margin-bottom: 4px; }
        .install-header p { font-size: 13px; color: var(--mx-text-tertiary); }
        .install-step { display: flex; justify-content: center; gap: 8px; padding: 20px 24px 0; }
        .install-step-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--mx-bg-tertiary); transition: all var(--mx-transition); }
        .install-step-dot.active { background: var(--mx-accent); width: 24px; border-radius: 4px; }
        .install-step-dot.done { background: var(--mx-success); }
        .install-body { padding: 24px; }
        .install-footer { padding: 16px 24px; border-top: 1px solid var(--mx-border); text-align: center; font-size: 12px; color: var(--mx-text-tertiary); }
    </style>
</head>
<body>
<div class="install-card mx-animate">
    <div class="install-header">
        <h1>彩虹易支付</h1>
        <p>安装程序</p>
    </div>
    <div class="install-step">
        <?php
        $currentStep = $step;
        if($step==1) $currentStep=1;
        elseif($step==2) $currentStep=2;
        elseif($step==3) $currentStep=3;
        elseif($step==4) $currentStep=4;
        elseif($step==5) $currentStep=5;
        for($i=1;$i<=5;$i++):
            $cls = '';
            if($i < $currentStep) $cls = 'done';
            elseif($i == $currentStep) $cls = 'active';
        ?>
        <div class="install-step-dot <?php echo $cls?>"></div>
        <?php endfor; ?>
    </div>
    <div class="install-body">
        <?php if($step==2): ?>
        <form action="?step=3" method="post">
            <div class="mx-input-group">
                <label class="mx-label">数据库地址</label>
                <input type="text" name="host" class="mx-input" value="localhost" required>
            </div>
            <div class="mx-input-group">
                <label class="mx-label">数据库端口</label>
                <input type="text" name="port" class="mx-input" value="3306" required>
            </div>
            <div class="mx-input-group">
                <label class="mx-label">数据库用户名</label>
                <input type="text" name="user" class="mx-input" required>
            </div>
            <div class="mx-input-group">
                <label class="mx-label">数据库密码</label>
                <input type="text" name="pwd" class="mx-input" required>
            </div>
            <div class="mx-input-group">
                <label class="mx-label">数据库名称</label>
                <input type="text" name="database" class="mx-input" required>
            </div>
            <div class="mx-input-group">
                <label class="mx-label">数据表前缀</label>
                <input type="text" name="dbqz" class="mx-input" value="pay" readonly>
            </div>
            <div style="margin-top:24px">
                <button type="submit" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg">确认无误，下一步</button>
            </div>
            <div style="text-align:center;margin-top:12px">
                <a href="?step=3&jump=1" style="font-size:13px;color:var(--mx-text-tertiary)">已事先填写好 config.php？跳过此步</a>
            </div>
        </form>

        <?php elseif($step==3): ?>
            <?php if(!empty($errorMsg)): ?>
                <div class="mx-alert mx-alert-danger"><?php echo htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8')?></div>
                <a href="javascript:history.back(-1)" class="mx-btn mx-btn-secondary mx-btn-block" style="margin-top:16px">返回上一页</a>
            <?php else: ?>
                <div class="mx-alert mx-alert-success">数据库配置文件保存成功！</div>
                <?php if($DB->query("select * from ".$dbconfig['dbqz']."_config")): ?>
                    <div class="mx-alert mx-alert-info">系统检测到你已安装过彩虹易支付</div>
                    <div style="display:flex;gap:12px;margin-top:16px">
                        <a href="?step=4&jump=1" class="mx-btn mx-btn-secondary" style="flex:1">跳过安装数据表</a>
                        <a href="?step=4" onclick="if(!confirm('全新安装将会清空所有数据，是否继续？')){return false;}" class="mx-btn mx-btn-primary" style="flex:1">强制全新安装</a>
                    </div>
                <?php else: ?>
                    <a href="?step=4" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" style="margin-top:16px">立即安装数据表 →</a>
                <?php endif; ?>
            <?php endif; ?>

        <?php elseif($step==4): ?>
            <div class="mx-alert mx-alert-danger"><?php echo nl2br(htmlspecialchars($errorMsg ?? '', ENT_QUOTES, 'UTF-8'))?></div>
            <div style="display:flex;gap:12px;margin-top:16px">
                <a href="javascript:history.back(-1)" class="mx-btn mx-btn-secondary" style="flex:1">返回上一页</a>
                <a href="?step=4" class="mx-btn mx-btn-primary" style="flex:1">重试</a>
            </div>

        <?php elseif($step==5): ?>
            <?php if($success>0): ?>
                <div class="mx-alert mx-alert-success">成功执行 <?php echo $success?> 条 SQL 语句<?php if($error>0){ ?>，失败 <?php echo $error?> 条<?php } ?></div>
            <?php endif; ?>
            <div class="mx-list" style="margin-top:16px">
                <div class="mx-list-item">✓ 系统已成功安装完毕</div>
                <div class="mx-list-item">✓ 后台地址：<a href="/admin/" target="_blank">/admin/</a> 密码: 123456</div>
                <div class="mx-list-item">✓ 请及时修改后台管理员密码</div>
                <?php if(!$lock_status): ?>
                <div class="mx-list-item" style="color:var(--mx-danger)">⚠ 空间不支持本地文件读写，请自行在 /install/ 目录建立 install.lock 文件</div>
                <?php endif; ?>
            </div>
            <a href="/" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" style="margin-top:24px">进入网站首页</a>

        <?php else: ?>
            <?php
            $install=true;
            $checks = [];
            if(function_exists('curl_exec')){$checks[]=['CURL组件',true];}else{$checks[]=['CURL组件',false];$install=false;}
            if(class_exists("PDO")){$checks[]=['PDO_MYSQL组件',true];}else{$checks[]=['PDO_MYSQL组件',false];$install=false;}
            if(is_writable($databaseFile)){$checks[]=['主目录写入权限',true];}else{$checks[]=['主目录写入权限',false];}
            if(version_compare(PHP_VERSION,'7.4.0','<')){$checks[]=['PHP版本 ≥ 7.4',false];$install=false;}else{$checks[]=['PHP版本 ≥ 7.4',true];}
            ?>
            <div class="mx-list">
                <?php foreach($checks as $c): ?>
                <div class="mx-list-item">
                    <?php if($c[1]): ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m8 12.5 2.5 3 5.5-6"/></svg>
                    <?php else: ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-danger)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    <?php endif; ?>
                    <span style="margin-left:12px"><?php echo $c[0]?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <div style="margin-top:8px;padding:0 4px;font-size:13px;color:var(--mx-text-tertiary);line-height:1.6">
                成功安装后安装文件会自动锁定，如需重新安装请手动删除 install 目录下 install.lock 文件
            </div>
            <?php if($install): ?>
                <a href="?step=2" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" style="margin-top:20px">检测通过，下一步</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="install-footer">Powered by 彩虹易支付</div>
</div>
</body>
</html>
