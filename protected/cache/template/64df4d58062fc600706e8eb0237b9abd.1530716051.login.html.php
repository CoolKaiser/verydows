<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<meta name="keywords" content="用户登录" />
<meta name="description" content="用户登录" />
<title>用户登陆 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/login.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
<script type="text/javascript">
function login(btn){
  $('#username').vdsFieldChecker({rules:{required:[true, '请输入用户名']}, tipsPos:'abs'});
  $('#password').vdsFieldChecker({rules:{required:[true, '请输入密码']}, tipsPos:'abs'});
  if($('#captcha').size() > 0){
    $('#captcha').vdsFieldChecker({rules: {required:[true, '请输入验证码']}, tipsPos:'abs'});
  }
  $('#login-form').vdsFormChecker({
    beforeSubmit: function(){
      vdsSetCipher('password', 'Verydows');
      $(btn).addClass('disabled').text('正在登陆').prop('disabled', true);
    }
  });
}

function resetCaptcha(){
  var src = "<?php echo url(array('c'=>'api/captcha', 'a'=>'image', 'v'=>'random', ));?>";
  $('#captcha-img').attr('src', src.replace('random', Math.random()));
  $('#captcha').focus();
}
</script>
</head>
<body>
<!-- 头部开始 -->
<div class="header">
  <div class="w900 mt30 cut">
    <div class="logo"><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>"><img src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/logo.gif" /></a></div>
  </div>
</div>
<!-- 头部结束 -->
<!-- 主体开始 -->
<div class="container w900 mt20">
  <div class="wbox cut">
    <div class="login-banner fl cut"><?php echo layout_adv(array('id'=>'3', ));?></div>
    <form method="post" action="<?php echo url(array('c'=>'user', 'a'=>'login', 'step'=>'submit', ));?>" id="login-form">
      <input type="password" value="" class="hide" />
      <div class="login ml530">
        <h2 class="c666">用户登录</h2>
        <dl class="username mt20">
          <dt><i class="icon"></i></dt>
          <dd><input name="username" id="username" type="text" placeholder="请输入用户名" /></dd>
        </dl>
        <dl class="pwd mt20">
          <dt><i class="icon"></i></dt>
          <dd><input name="password" id="password" type="password" placeholder="请输入密码" /></dd>
        </dl>
        <?php if (!empty($captcha)) : ?>
        <dl class="captcha mt20">
          <dt><i class="icon"></i></dt>
          <dd><input name="captcha" id="captcha" type="text" placeholder="请输入验证码" /></dd>
        </dl>
        <div class="captcha mt15">
          <a class="fr" onclick="resetCaptcha()"><i class="refresh icon"></i><font>点击刷新</font></a>
          <img src="<?php echo url(array('c'=>'api/captcha', 'a'=>'image', ));?>" id="captcha-img" />
        </div>
        <?php endif; ?>
        <div class="ck module mt20 cut">
          <div class="fl"><label><input name="stay" type="checkbox" value="1" /><font class="ml5">一周内自动登录</font></label></div>
          <div class="fr"><a href="<?php echo url(array('c'=>'retrieve', 'a'=>'password', ));?>">忘记密码？</a></div>
        </div>
        <a class="form-submit aln-c radius4 mt20" href="javascript:void(0)" onclick="login(this)">登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;陆</a>
        <div class="c999 mt20">您还没有账号？ 立即<a class="ml5" href="<?php echo url(array('c'=>'user', 'a'=>'register', ));?>">免费注册</a></div>
        <?php if (!empty($oauth_list)) : ?>
        <div class="oauthli mt50 aln-c">
          <p class="c888">使用其他方式登录</p>
          <div class="line mt5 mb5"></div>
          <div class="pad10">
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($oauth_list);?><?php foreach( $oauth_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <a href="<?php echo htmlspecialchars($v['url'], ENT_QUOTES, "UTF-8"); ?>"><img alt="<?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/plugin/oauth/icon/<?php echo htmlspecialchars($v['party'], ENT_QUOTES, "UTF-8"); ?>.png" /></a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </form>
  </div>
</div>
<!-- 主体结束 -->
<div class="cl"></div>
<!-- 页脚开始 -->
<?php echo layout_footer();?>
<!-- 页脚结束 -->
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/md5.js"></script>
</body>
</html>