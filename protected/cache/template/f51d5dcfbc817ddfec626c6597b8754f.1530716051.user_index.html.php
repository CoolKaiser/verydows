<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<title>用户中心 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/user.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
</head>
<body>
<!-- 顶部开始 -->
<?php echo layout_topper(array('common'=>$common, ));?>
<!-- 顶部结束 -->
<!-- 头部开始 -->
<?php echo layout_header(array('common'=>$common, ));?>
<!-- 头部结束 -->
<div class="loc w1100">
  <div><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">网站首页</a><b>&gt;</b><font>用户中心</font></div>
</div>
<!-- 主体开始 -->
<div class="container w1100 mt10">
  <div class="module cut">
    <!-- 左侧开始 -->
    <div class="w180 fl cut">
      <!-- 用户菜单开始 -->
      <?php echo layout_usermenu();?>
      <!-- 用户菜单结束 -->
    </div>
    <!-- 左侧结束 -->
    <!-- 右侧开始 -->
    <div class="w910 cut">
      <div class="w660 fl cut">
        <div class="welcome w658 cut">
          <h3>您好<font class="c333 ml5"><?php if (!empty($user['profile']['name'])) : ?><?php echo htmlspecialchars($user['profile']['name'], ENT_QUOTES, "UTF-8"); ?><?php else : ?><?php echo htmlspecialchars($user['username'], ENT_QUOTES, "UTF-8"); ?><?php endif; ?></font>，欢迎登陆<font class="ml5"><?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></font></h3>
          <?php if ($user['email_status'] == 0) : ?>
          <p class="remind red">您的邮箱还未通过邮件认证</font><a class="ml10" href="<?php echo url(array('c'=>'security', 'a'=>'index', ));?>">[立即认证]</a></p>
          <?php endif; ?>
          <div class="module mt10 cut">
            <dl><dt>账户余额：</dt><dd><font class="red"><?php echo htmlspecialchars($user['account']['balance'], ENT_QUOTES, "UTF-8"); ?></font> 元</dd></dl>
            <dl><dt>积分：</dt><dd><font class="red">0</font></dd></dl>
            <dl><dt>成长值：</dt><dd><?php echo htmlspecialchars($user['account']['exp'], ENT_QUOTES, "UTF-8"); ?></dd></dl>
            <dl><dt>会员类别：</dt><dd><font><?php echo htmlspecialchars($user['account']['group_name'], ENT_QUOTES, "UTF-8"); ?></font></dd></dl>
            <dl><dt>上次登录：</dt><dd><font class="c999"><?php echo date('Y年m月d日 H:i', $_SESSION['USER']['LAST_DATE']);?></font></dd></dl>
          </div>
        </div>
        <!-- 最近订单开始 -->
        <div class="w658 mt10 cut">
          <h2><a href="<?php echo url(array('c'=>'order', 'a'=>'list', ));?>" class="fr">查看全部订单</a>近期订单</h2>
          <?php if (!empty($order_list)) : ?>
          <div class="tli">
            <table>
              <tr>
                <th class="aln-l">订单号</th>
                <th width="110" class="aln-l">订单总额</th>
                <th width="110">订单状态</th>
                <th width="110">下单日期</th>
                <th width="90">操作</th>
              </tr>
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($order_list);?><?php foreach( $order_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <tr>
                <td class="aln-l"><a href="<?php echo url(array('c'=>'order', 'a'=>'view', 'id'=>$v['order_id'], ));?>"><?php echo htmlspecialchars($v['order_id'], ENT_QUOTES, "UTF-8"); ?></a></td>
                <td class="aln-l"><font class="cny">¥</font> <?php echo htmlspecialchars($v['order_amount'], ENT_QUOTES, "UTF-8"); ?></td>
                <td><?php echo htmlspecialchars($v['progress'], ENT_QUOTES, "UTF-8"); ?></td>
                <td><?php echo date('Y-m-d', $v['created_date']);?></td>
                <td><a href="<?php echo url(array('c'=>'order', 'a'=>'view', 'id'=>$v['order_id'], ));?>">查看</a></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <?php else : ?>
          <p class="aln-c pad10 c999">暂无订单</p>
          <?php endif; ?>
        </div>
        <!-- 最近订单结束 -->
        <!-- 最近收藏开始 -->
        <div class="w658 mt10 cut">
          <h2><a href="<?php echo url(array('c'=>'favorite', 'a'=>'list', ));?>" class="fr">查看全部收藏</a>近期收藏</h2>
          <?php if (!empty($favorite_list)) : ?>
          <div class="tli">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <th colspan="2">商品</th>
                <th width="110">日期</th>
              </tr>
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($favorite_list);?><?php foreach( $favorite_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <tr>
                <td><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></td>
                <td>
                  <p class="aln-l"><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a></p>
                  <p class="aln-l red mt5"><font class="cny">¥</font> <?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
                </td>
                <td><?php echo date('Y-m-d', $v['created_date']);?></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <?php else : ?>
          <p class="aln-c pad10 c999">暂无收藏</p>
          <?php endif; ?>
        </div>
        <!-- 最近收藏结束 -->
      </div>
      <div class="w240 fr cut">
        <div class="sdcter cut">
          <h2 class="srth"><a class="fr" href="<?php echo url(array('c'=>'user', 'a'=>'profile', ));?>">编辑</a>个人信息</h2>
          <div class="module mt10 cut">
            <?php if (!empty($user['avatar'])) : ?>
            <div class="avatar fl"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/user/avatar/<?php echo htmlspecialchars($user['avatar'], ENT_QUOTES, "UTF-8"); ?>" /></div>
            <?php else : ?>
            <div class="avatar fl"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/image/noavatar_m.gif" /></div>
            <?php endif; ?>
            <ul>
              <li>昵称:<?php if (!empty($user['profile']['nickname'])) : ?><b class="ml8"><?php echo htmlspecialchars($user['profile']['nickname'], ENT_QUOTES, "UTF-8"); ?></b><?php else : ?><font class="c999 ml8">未设置</font><?php endif; ?></li>
              <li>性别:<b class="ml8"><?php if ($user['profile']['gender'] == 1) : ?>男<?php elseif ($user['profile']['gender'] == 2) : ?>女<?php else : ?>保密<?php endif; ?></b></li>
              <li><a href="<?php echo url(array('c'=>'user', 'a'=>'logout', ));?>">退出登录</a></li>
            </ul>
          </div>
        </div>
        <!-- 最近浏览开始 -->
        <div class="history sli mt10">
          <h2 class="srth">最近浏览</h2>
          <?php if (!empty($history)) : ?>
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($history);?><?php foreach( $history as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <dl>
            <dt><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></dt>
            <dd class="lt"><a title="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo truncate($v['goods_name'], 35);?></a><p><i>¥</i> <?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p></dd>
          </dl>
          <?php endforeach; ?>
          <?php else : ?>
          <p class="pad10 c999">尚未浏览过任何商品</p>
          <?php endif; ?>
        </div>
        <!-- 最近浏览结束 -->
      </div>
    </div>
    <!-- 右侧结束 -->
  </div>
  <div class="cl"></div>
  <?php echo layout_helper();?>
</div>
<!-- 主体结束 -->
<div class="cl"></div>
<!-- 页脚开始 -->
<?php echo layout_footer();?>
<!-- 页脚结束 -->
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
</body>
</html>