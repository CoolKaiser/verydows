<?php if(!class_exists("View", false)) exit("no direct access allowed");?><div class="topper">
  <div class="w1100 x-auto">
    <div class="topper-userbar fl" id="top-userbar"></div>
    <div class="topper-links fr"><?php $_foreach_v_counter = 0; $_foreach_v_total = count($nav);?><?php foreach( $nav as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?><a href="<?php echo htmlspecialchars($v['link'], ENT_QUOTES, "UTF-8"); ?>" <?php echo $v['target']; ?>><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a><span class="sep">|</span><?php endforeach; ?></div>
  </div>
</div>
<script type="text/template" id="logined-userbar-tpl">
<a class="m"><i class="icon"></i>${username}</span><b class="icon"></b></a><font class="c999 ml10">欢迎您回来!</font>
<div class="m hide">
  <div class="avatar fl">
    {@if avatar != null}
    <a href="<?php echo url(array('c'=>'user', 'a'=>'profile', ));?>"><img width="60" height="60" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/user/avatar/${avatar}" /></a>
    {@else}
    <a href="<?php echo url(array('c'=>'user', 'a'=>'index', ));?>"><img width="60" height="60" href="<?php echo url(array('c'=>'user', 'a'=>'profile', ));?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/image/noavatar_m.gif" /></a>
    {@/if}
  </div>
  <ul>
    <li><a href="<?php echo url(array('c'=>'user', 'a'=>'index', ));?>">进入用户中心</a></li>
    <li><a href="<?php echo url(array('c'=>'user', 'a'=>'profile', ));?>">编辑资料</a></li>
    <li><a href="<?php echo url(array('c'=>'user', 'a'=>'logout', ));?>">退出</a></li>
  </ul>
</div>
</script>
<script type="text/template" id="unlogined-userbar-tpl">
<font class="c666 mr20">嗨！欢迎来到 <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></font>
<a href="<?php echo url(array('c'=>'user', 'a'=>'login', ));?>">登陆</a>
<span class="sep">|</span>
<a href="<?php echo url(array('c'=>'user', 'a'=>'register', ));?>" class="red">免费注册</a>
</script>