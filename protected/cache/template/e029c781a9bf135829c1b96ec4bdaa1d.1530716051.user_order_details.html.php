<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单详情 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/user.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
<script type="text/javascript">
$(function(){countdown()});

function countdown(){
  var obj = $('#countdown');
  if(obj.size() == 0) return false;
  var _countdown = parseInt(obj.data('countdown'));
  window.setInterval(function(){
    var _d = 0, _h = 0, _m = 0, _s = 0;
    if(_countdown > 0){
      _d = Math.floor(_countdown / (60 * 60 * 24));
      _h = Math.floor(_countdown / (60 * 60)) - (_d * 24);
      _m = Math.floor(_countdown / 60) - (_d * 24 * 60) - (_h * 60);
      _s = Math.floor(_countdown) - (_d * 24 * 60 * 60) - (_h * 60 * 60) - (_m * 60);
    }
    if(_m <= 9) _m = '0' + _m;
    if(_s <= 9) _s = '0' + _s;
    obj.text(_d+'天'+_h+'小时'+_m+'分'+_s+'秒');
    _countdown --;
    obj.data('countdown', _countdown);
  }, 1000);
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
        <h2>订单号：<?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, "UTF-8"); ?></h2>
        <div class="order cut">
          <div class="order-step mt20 cut">
            <ul id="order-step">
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($progress);?><?php foreach( $progress as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <?php if ($_foreach_v_iteration == $_foreach_v_total) : ?>
              <li <?php if ($order['order_status'] == 4) : ?>class="s-<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?> ok"<?php else : ?>class="s-<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?>"<?php endif; ?>><h4><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></h4><i></i></li>
              <?php else : ?>
              <li class="s-<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?> ok"><h4><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></h4><i></i></li>
              <li class="arrow ok"><i></i></li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="sdcter mt20 cut">
            <div class="w360 fl cut">
              <dl>
                <dt>下单时间：</dt>
                <dd><?php echo date('Y-m-d H:i:s', $order['created_date']);?></dd>
              </dl>
              <dl class="mt5">
                <dt>收件人信息：</dt>
                <dd>
                  <p><?php echo htmlspecialchars($consignee['receiver'], ENT_QUOTES, "UTF-8"); ?><font class="c666 ml10">(手机号码：<?php echo htmlspecialchars($consignee['mobile'], ENT_QUOTES, "UTF-8"); ?>)</font></p>
                  <p class="mt5"><?php echo htmlspecialchars($consignee['province'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee['city'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee['borough'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee['address'], ENT_QUOTES, "UTF-8"); ?></p>
                  <?php if (!empty($consignee['zip'])) : ?><p class="mt5"><?php echo htmlspecialchars($consignee['zip'], ENT_QUOTES, "UTF-8"); ?></p><?php endif; ?>
                </dd>
              </dl>
              <dl class="mt5">
                <dt>配送方式：</dt>
                <dd><?php echo htmlspecialchars($order['shipping_method_name'], ENT_QUOTES, "UTF-8"); ?></dd>
              </dl>
              <dl class="mt5">
                <dt>支付方式：</dt>
                <dd><?php echo htmlspecialchars($order['payment_method_name'], ENT_QUOTES, "UTF-8"); ?></dd>
              </dl>
              <dl class="mt5">
                <dt>订单金额：</dt>
                <dd><b class="red"><font class="cny">¥</font><?php echo htmlspecialchars($order['order_amount'], ENT_QUOTES, "UTF-8"); ?></b><span class="c666 ml10">(含运费：<font class="cny">¥</font><?php echo htmlspecialchars($order['shipping_amount'], ENT_QUOTES, "UTF-8"); ?>)</span></dd>
              </dl>
              <dl class="mt5">
                <dt>留言备注：</dt>
                <dd><?php if (!empty($order['memos'])) : ?><font class="c777"><?php echo htmlspecialchars($order['memos'], ENT_QUOTES, "UTF-8"); ?></font><?php else : ?><font class="c999">无</font><?php endif; ?></dd>
              </dl>
            </div>
            <div class="cdo aln-c cut">
              <h3 class="f14 c666">订单状态：<font class="c333"><?php echo array_pop($progress);?></font></h3>
              <?php if (!empty($carrier) && !empty($shipping)) : ?>
              <div class="module mt20">
                <p class="c888"> 物流：<font class="c333"><?php echo htmlspecialchars($carrier['name'], ENT_QUOTES, "UTF-8"); ?></font><span class="ml5 mr5"></span> 运单号：<a href="<?php echo htmlspecialchars($carrier['tracking_url'], ENT_QUOTES, "UTF-8"); ?><?php echo htmlspecialchars($shipping['tracking_no'], ENT_QUOTES, "UTF-8"); ?>" target="_blank"><?php echo htmlspecialchars($shipping['tracking_no'], ENT_QUOTES, "UTF-8"); ?></a><span class="ml5 mr5"></span> 客服电话：<font class="c333"><?php echo htmlspecialchars($carrier['service_tel'], ENT_QUOTES, "UTF-8"); ?></font> </p>
              </div>
              <?php endif; ?>
              <?php if (!empty($countdown)) : ?>
              <div class="c666 mt10">还有 <font class="red" id="countdown" data-countdown="<?php echo htmlspecialchars($countdown, ENT_QUOTES, "UTF-8"); ?>">0天0小时0分0秒</font> <?php if ($order['order_status'] == 1) : ?>来付款，超时订单将自动取消<?php else : ?>确认签收，超时订单将自动签收<?php endif; ?></div>
              <?php endif; ?>
              <div class="module mt20">
                <?php if ($order['order_status'] == 1) : ?>
                <?php if ($order['payment_method'] != 2) : ?>
                <a class="sm-red mr10" href="<?php echo url(array('c'=>'pay', 'a'=>'index', 'order_id'=>$order['order_id'], ));?>">去付款</a>
                <?php endif; ?>
                <a class="sm-gray ml10" href="<?php echo url(array('c'=>'order', 'a'=>'cancel', 'id'=>$order['order_id'], ));?>">取消订单</a>
                <?php elseif ($order['order_status'] == 3) : ?>
                <a class="sm-red mr10" href="<?php echo url(array('c'=>'order', 'a'=>'delivered', 'id'=>$order['order_id'], ));?>">确认签收</a>
                <?php elseif ($order['order_status'] == 4) : ?>
                <a class="sm-red mr10" href="<?php echo url(array('c'=>'review', 'a'=>'order', 'order_id'=>$order['order_id'], ));?>">评价</a>
                <a class="sm-gray mr10" href="<?php echo url(array('c'=>'aftersales', 'a'=>'order', 'order_id'=>$order['order_id'], ));?>">申请售后</a>
                <?php elseif ($order['order_status'] == 0) : ?>
                <a class="sm-blue mr10" href="<?php echo url(array('c'=>'order', 'a'=>'rebuy', 'id'=>$order['order_id'], ));?>">重新购买</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- 商品清单开始 -->
          <div class="tli mt10">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <th colspan="2">商品</th>
                <th width="18%">单价(元)</th>
                <th width="18%">数量</th>
                <th width="18%">小计(元)</th>
              </tr>
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($goods_list);?><?php foreach( $goods_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <tr>
                <td width="80"><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>" target="_blank"><img class="gim" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></td>
                <td>
                  <div class="aln-l">
                    <a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>" target="_blank"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a>
                    <?php if (!empty($v['goods_opts'])) : ?>
                    <p class="c999 mt5"><?php $_foreach_o_counter = 0; $_foreach_o_total = count($v['goods_opts']);?><?php foreach( $v['goods_opts'] as $o ) : ?><?php $_foreach_o_index = $_foreach_o_counter;$_foreach_o_iteration = $_foreach_o_counter + 1;$_foreach_o_first = ($_foreach_o_counter == 0);$_foreach_o_last = ($_foreach_o_counter == $_foreach_o_total - 1);$_foreach_o_counter++;?><span class="mr5">[<?php echo htmlspecialchars($o['opt_type'], ENT_QUOTES, "UTF-8"); ?>: <font class="c666"><?php echo htmlspecialchars($o['opt_text'], ENT_QUOTES, "UTF-8"); ?></font>]</span><?php endforeach; ?></p>
                    <?php endif; ?>
                  </div>
                </td>
                <td><?php echo htmlspecialchars($v['goods_price'], ENT_QUOTES, "UTF-8"); ?></td>
                <td><?php echo htmlspecialchars($v['goods_qty'], ENT_QUOTES, "UTF-8"); ?></td>
                <td><?php echo sprintf('%.2f', $v['goods_price']*$v['goods_qty']);?></td>
              </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5"><div class="total fr cut">
                    <dl>
                      <dt>运费：</dt>
                      <dd><font class="cny">¥</font> <?php echo htmlspecialchars($order['shipping_amount'], ENT_QUOTES, "UTF-8"); ?></dd>
                    </dl>
                    <dl>
                      <dt>应付款总额：</dt>
                      <dd class="red"><font class="cny">¥</font> <?php echo htmlspecialchars($order['order_amount'], ENT_QUOTES, "UTF-8"); ?></dd>
                    </dl>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <!-- 商品清单结束 -->
        </div>
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