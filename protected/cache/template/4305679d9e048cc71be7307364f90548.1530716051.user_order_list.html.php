<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<title>我的订单 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/user.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
<script type="text/javascript">
function cancelOrder(e, order_id){
  $(e).vdsConfirm({
    text: '您确定要取消该订单吗?',
    top: -25,
    ok: function(){
      window.location.href = "<?php echo url(array('c'=>'order', 'a'=>'cancel', 'id'=>'"+order_id', ));?>;
    },
  });
}
</script>
</head>
<body>
<!-- 顶部开始 -->
<?php echo layout_topper(array('common'=>$common, ));?>
<!-- 顶部结束 -->
<!-- 头部开始 -->
<?php echo layout_header(array('common'=>$common, ));?>
<!-- 头部结束 -->
<div class="loc w1100">
  <div><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">网站首页</a><b>></b><font>我的订单</font></div>
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
      <div class="mcter">
        <h2>我的订单</h2>
        <?php if (!empty($order_list['rows'])) : ?>
        <div class="order cut">
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($order_list['rows']);?><?php foreach( $order_list['rows'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <div class="tli cut">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <th colspan="4">
                  <div class="fl aln-l cut">订单号：<b><?php echo htmlspecialchars($v['order_id'], ENT_QUOTES, "UTF-8"); ?></b><span class="sep"></span>下单日期：<b><?php echo date('Y-m-d', $v['created_date']);?></b></div>
                  <div class="fr"><a href="<?php echo url(array('c'=>'order', 'a'=>'view', 'id'=>$v['order_id'], ));?>">订单详情</a></div>
                </th>
              </tr>
              <tr>
                <td>
                  <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['goods_list']);?><?php foreach( $v['goods_list'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
                  <dl>
                    <dt><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$vv['goods_id'], ));?>" target="_blank"><img class="gim" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($vv['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></dt>
                    <dd>
                      <p><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$vv['goods_id'], ));?>" target="_blank"><?php echo htmlspecialchars($vv['goods_name'], ENT_QUOTES, "UTF-8"); ?></a></p>
                      <?php if (!empty($vv['goods_opts'])) : ?>
                      <p class="c999 mt5"><?php $_foreach_o_counter = 0; $_foreach_o_total = count($vv['goods_opts']);?><?php foreach( $vv['goods_opts'] as $o ) : ?><?php $_foreach_o_index = $_foreach_o_counter;$_foreach_o_iteration = $_foreach_o_counter + 1;$_foreach_o_first = ($_foreach_o_counter == 0);$_foreach_o_last = ($_foreach_o_counter == $_foreach_o_total - 1);$_foreach_o_counter++;?><span class="mr5">[<?php echo htmlspecialchars($o['opt_type'], ENT_QUOTES, "UTF-8"); ?>: <font class="c666"><?php echo htmlspecialchars($o['opt_text'], ENT_QUOTES, "UTF-8"); ?></font>]</span><?php endforeach; ?></p>
                      <?php endif; ?>
                      <p class="mt5"><span class="c999 mr5">单价：</span><font class="cny">¥</font> <?php echo htmlspecialchars($vv['goods_price'], ENT_QUOTES, "UTF-8"); ?></p>
                      <p class="mt5"><span class="c999 mr5">数量：</span><?php echo htmlspecialchars($vv['goods_qty'], ENT_QUOTES, "UTF-8"); ?></p>
                    </dd>
                  </dl>
                  <?php endforeach; ?>
                </td>
                <td width="120"><p><font class="cny">¥</font> <?php echo htmlspecialchars($v['order_amount'], ENT_QUOTES, "UTF-8"); ?></p><p class="mt5 c999">(含运费：<font class="cny">¥</font> <?php echo htmlspecialchars($v['shipping_amount'], ENT_QUOTES, "UTF-8"); ?>)</p></td>
                <td width="120"><?php echo htmlspecialchars($payment_map[$v['payment_method']]['name'], ENT_QUOTES, "UTF-8"); ?></td>
                <td width="120">
                  <?php if ($v['order_status'] == 1) : ?>
                  <?php if ($v['payment_method'] != 2) : ?>
                  <p><a class="sm-red btn" href="<?php echo url(array('c'=>'pay', 'a'=>'index', 'order_id'=>$v['order_id'], ));?>">立即付款</a></p>
                  <?php endif; ?>
                  <p class="mt10"><button type="button" class="sm-gray btn" onclick="cancelOrder(this, '<?php echo htmlspecialchars($v['order_id'], ENT_QUOTES, "UTF-8"); ?>')">取消订单</button></p>
                  <?php elseif ($v['order_status'] == 3) : ?>
                  <p><a class="sm-red btn" href="<?php echo url(array('c'=>'order', 'a'=>'delivered', 'id'=>$v['order_id'], ));?>">签收</a></p>
                  <?php elseif ($v['order_status'] == 4) : ?>
                  <p><a class="sm-blue btn" href="<?php echo url(array('c'=>'review', 'a'=>'order', 'order_id'=>$v['order_id'], ));?>">评价</a></p>
                  <p class="mt10"><a class="sm-gray btn" href="<?php echo url(array('c'=>'aftersales', 'a'=>'order', 'order_id'=>$v['order_id'], ));?>">售后</a></p>
                  <?php elseif ($v['order_status'] == 0) : ?>
                  <p><a class="sm-blue btn" href="<?php echo url(array('c'=>'order', 'a'=>'rebuy', 'id'=>$v['order_id'], ));?>">重新购买</a></p>
                  <?php else : ?>
                  <p><a class="sm-blue btn" href="<?php echo url(array('c'=>'order', 'a'=>'view', 'id'=>$v['order_id'], ));?>">查看</a></p>
                  <?php endif; ?>
                </td>
              </tr>
            </table>
          </div>
          <?php endforeach; ?>
          <?php if (!empty($order_list['paging'])) : ?>
          <div class="aln-c mt10 pad10 cut"><?php echo layout_paging(array('paging'=>$order_list['paging'], 'class'=>'paging small', 'c'=>'order', 'a'=>'list', ));?></div>
          <?php endif; ?> </div>
        <?php else : ?>
        <div class="pad10 aln-c c999">暂无任何订单记录</div>
        <?php endif; ?>
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
