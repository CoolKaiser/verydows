<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<title>抱歉! 您所访问的页面不存在 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<meta name="keywords" content="404, 404 Error, 页面不存在" />
<meta name="description" content="抱歉! 您所访问的页面不存在" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/prompt.css" />
</head>
<body>
<div class="w800 cut">
  <div class="aln-c"><img alt="<?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/logo.gif" /></div>
  <div class="err404 mt20">
    <div class="aln-c"><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">返回首页</a></div>
  </div>
</div>
</body>
</html>