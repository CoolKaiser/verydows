<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<title>付款 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/order.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
<script type="text/javascript">
function showPaymentSelect(){
  $('#payment-select span').hide();
  $('#payment-select select').show();
}

function changePayment(e){
  if(e.value != '<?php echo htmlspecialchars($order['payment_method'], ENT_QUOTES, "UTF-8"); ?>') $('#change-payment-form').submit();
}

function doPay(){
    document.form1.submit();
    var popup = $('#uponpay');
    $.vdsMasker(true);
    popup.vdsMidst().show().find('a.close').click(function(){
      $.vdsMasker(false);
      popup.hide();
    });
}
</script>
</head>
<body>
<!-- 顶部开始 -->
<?php echo layout_topper(array('common'=>$common, ));?>
<!-- 顶部结束 -->
<!-- 头部开始 -->
<div class="header">
  <div class="w1100 cut">
    <div class="logo"><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>"><img src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/logo.gif" /></a></div>
  </div>
</div>
<!-- 头部结束 -->
<!-- 主体开始 -->
<div class="container w1100 mt30">
  <div class="paybox">
    <div class="payinfo">
      <table>
        <tr>
          <th width="80">订单编号：</th>
          <td><?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
          <th>订单金额：</th>
          <td><b class="red"><?php echo htmlspecialchars($order['order_amount'], ENT_QUOTES, "UTF-8"); ?></b></td>
        </tr>
        <tr>
          <th>付款方式：</th>
          <td id="payment-select">
            <span><font><?php echo htmlspecialchars($payment['name'], ENT_QUOTES, "UTF-8"); ?></font><a class="f12 sm-gen ml10 pointer" onclick="showPaymentSelect()">更改付款方式</a></span>
            <form method="post" action="<?php echo url(array('c'=>'pay', 'a'=>'index', 'order_id'=>$order['order_id'], ));?>" id="change-payment-form">
              <select name="change_payment" class="slt hide" onchange="changePayment(this)">
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($payment_list);?><?php foreach( $payment_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?> <option value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>"<?php if ($order['payment_method'] == $v['id']) : ?> selected="selected"<?php endif; ?>><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?>
                </option>
                <?php endforeach; ?>
              </select>
            </form>
          </td>
        </tr>
      </table>
      <form name="form1" method="POST" action="<?php echo htmlspecialchars($url, ENT_QUOTES, "UTF-8"); ?>" target="_blank">
        <?php $_foreach_val_counter = 0; $_foreach_val_total = count($params);?><?php foreach( $params as $key => $val ) : ?><?php $_foreach_val_index = $_foreach_val_counter;$_foreach_val_iteration = $_foreach_val_counter + 1;$_foreach_val_first = ($_foreach_val_counter == 0);$_foreach_val_last = ($_foreach_val_counter == $_foreach_val_total - 1);$_foreach_val_counter++;?>
          <input type='hidden' name='<?php echo $key; ?>' value='<?php echo $val; ?>' />
        <?php endforeach; ?>
      </form>
    </div>
    <div class="paybtn mt30"><a onclick="doPay()" class="checkout-btn">立即付款</a></div>
  </div>
</div>
<!-- 主体结束 -->
<div class="cl"></div>
<!-- 页脚开始 -->
<?php echo layout_footer();?>
<!-- 页脚结束 -->
<!-- 弹出完成付款对话框开始 -->
<div class="uponpay hide" id="uponpay">
  <h2>支付提示<a class="close"><i class='icon'></i></a></h2>
  <div class="mt20 pad10"><p class="aln-c c666">请您在新打开的页面进行支付，在支付完成前请不要关闭该页面</p></div>
  <div class="mt20 aln-c"><a class="sm-red btn" href="<?php echo url(array('c'=>'order', 'a'=>'view', 'id'=>$order['order_id'], ));?>">已完成支付</a><a href="<?php echo url(array('c'=>'help', 'a'=>'view', 'id'=>'4', ));?>" class="sm-blue btn">支付遇到问题</a></div>
</div>
<!-- 弹出完成付款对话框结束 -->
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
</body>
</html>