<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<title>系统提示 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/prompt.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript">
$(function(){
  var $cd = $('#countdown'), $timer = parseInt($cd.text());
  var t = window.setInterval(function(){
    if($timer <= 1){window.clearInterval(t);}
    $timer --;
    $cd.text($timer);
    if($timer == 0){
      if($cd.data('redirect') == 'close'){
        window.open(location, '_self').close();
      }else{
        window.location.href = $cd.data('redirect');
      }
    }
  }, 1000); 
});
</script>
</head>
<body>
<div class="w800">
  <div class="aln-c"><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>"><img alt="<?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/logo.gif" /></a></div>
  <div class="prompt mt10">
    <h1 class="c666">系统提示</h1>
    <h3 class="mt20 <?php echo htmlspecialchars($rs['type'], ENT_QUOTES, "UTF-8"); ?>"><?php if (is_array($rs['text'])) : ?><?php $_foreach_v_counter = 0; $_foreach_v_total = count($rs['text']);?><?php foreach( $rs['text'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?><br /><?php endforeach; ?><?php else : ?><?php echo htmlspecialchars($rs['text'], ENT_QUOTES, "UTF-8"); ?><?php endif; ?></h3>
    <?php if ($rs['redirect'] != 'close') : ?>
    <p class="c999 mt20">您将在<font id="countdown" class="countdown" data-redirect="<?php echo $rs['redirect']; ?>"><?php echo htmlspecialchars($rs['time'], ENT_QUOTES, "UTF-8"); ?></font>秒后自动跳转到系统指定页面</p>
    <p class="mt20"><a href="<?php echo $rs['redirect']; ?>">如果浏览器没有自动跳转，请点击这里</a></p>
    <?php else : ?>
    <p class="c999 mt20">此页面将在<font id="countdown" class="countdown" data-redirect="<?php echo $rs['redirect']; ?>"><?php echo htmlspecialchars($rs['time'], ENT_QUOTES, "UTF-8"); ?></font>秒后自动关闭</p>
    <p class="mt20"><a href="#" onclick="window.opener = null; window.close();">点击直接关闭</a></p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
