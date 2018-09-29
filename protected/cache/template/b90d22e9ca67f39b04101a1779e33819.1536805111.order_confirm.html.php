<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<title>确认订单 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/order.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/consignee.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/order.js"></script>
<script type="text/javascript">
var areaApi = "<?php echo url(array('c'=>'api/area', 'a'=>'children', ));?>" , freightApi = "<?php echo url(array('c'=>'api/order', 'a'=>'freight', ));?>";

$(function(){
  var consigneeBox = $('#consignee-box');
  //初始化运费
  countFreight();
  //初始化地区选择
  getAreaSelect();
  //当改变收件人触发
  onChangeConsignee();
  //当改变配送方式触发
  onChangeShipping();
  //新建收件人地址
  $('#newadrbtn').on('click', function(){
    $(this).hide();
    consigneeBox.slideDown().find('span.vdsfielderr').remove();
    consigneeBox.find('form input[name="id"]').val('');
  });

  //收件人表单保存按钮点击
  consigneeBox.find('.consignee-btns button').eq(0).click(function(){
    if(!checkConsigneeForm('consignee-form')) return false;
    var form = consigneeBox.find('form'), saveBtn = $(this);
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: "<?php echo url(array('c'=>'api/consignee', 'a'=>'save', ));?>",
      data: form.serialize(),
      beforeSend: function(){
        saveBtn.removeClass('sm-blue').addClass('sm-gray').text('正在保存...').prop('disabled', true);
      },
      success: function(res){
        saveBtn.removeClass('sm-gray').addClass('sm-blue').text('保 存').prop('disabled', false);
        if(res.status == 'success'){
          res.data.province = form.find('select[name="province"] option:selected').text();
          res.data.city = form.find('select[name="city"] option:selected').text();
          res.data.borough = form.find('select[name="borough"] option:selected').text();
          var $ul = $('#consignee-list'), $li = juicer($('#consignee-row-tpl').html(), res.data);
          if(consigneeBox.find('form input[name="id"]').val() != ''){
            $ul.find('li.cur').replaceWith($li);
          }else{
            $ul.find('li.cur').removeClass('cur').find('input[type="radio"]').prop('checked', false);
            $ul.prepend($li);
            onChangeConsignee();
          }
          hideConsigneeBox();
        }
      }
    });
    
  });
  //收件人表单取消按钮点击
  consigneeBox.find('.consignee-btns button').eq(1).click(function(){
    hideConsigneeBox();
  });

  // 支付方式
  if($("input[name='payment_method']:checked").parent().siblings().hasClass('banklist')){
    $("input[name='payment_method']:checked").parent().parent().find('.banklist').show()
  }


  $("input[name='payment_method']").each(function(){
      $(this).click(function(){
          if($(this).parent().siblings().hasClass('banklist')){
              $(this).parent().parent().find('.banklist').show()
              $(this).parent().parent().siblings().find('.banklist').hide()
          }else{
              $(this).parent().parent().siblings().find('.banklist').hide()
          }
      })
  })
});
</script>
</head>
<body>
<!-- 顶部开始 -->
<?php echo layout_topper(array('common'=>$common, ));?>
<!-- 顶部结束 -->
<!-- 头部开始 -->
<div class="header">
  <div class="w1100 cut">
    <div class="logo fl"><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>"><img src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/logo.gif" /></a></div>
    <div class="step cut"><ul><li>我的购物车</li><li class="cur">确认订单</li><li>完成付款</li></ul></div>
  </div>
</div>
<!-- 头部结束 -->
<!-- 主体开始 -->
<div class="container w1100 mt30">
  <!-- 收件地址开始 -->
  <div class="consignee cut">
    <div class="th">
      <h2>收件地址信息</h2>
    </div>
    <div class="selection module">
      <ul id="consignee-list">
        <?php if (!empty($consignee_list)) : ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($consignee_list);?><?php foreach( $consignee_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <?php if ($_foreach_v_first == true) : ?>
        <li class="cur" data-json="<?php echo htmlspecialchars($v['json'], ENT_QUOTES, "UTF-8"); ?>">
          <span class="c999 fr"><a onclick="editConsignee(this)">编辑此地址</a></span>
          <label>
            <input class="mr5" type="radio" name="csn_id" value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>" checked="checked" />
            <b class="mr10"><?php echo htmlspecialchars($v['receiver'], ENT_QUOTES, "UTF-8"); ?></b> <?php echo htmlspecialchars($v['area']['province'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['area']['city'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['area']['borough'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['address'], ENT_QUOTES, "UTF-8"); ?> <font class="c666 ml10">(联系电话：<?php echo htmlspecialchars($v['mobile'], ENT_QUOTES, "UTF-8"); ?>)</font>
          </label>
        </li>
        <?php else : ?>
        <li data-json="<?php echo htmlspecialchars($v['json'], ENT_QUOTES, "UTF-8"); ?>">
          <span class="c999 fr"><a onclick="editConsignee(this)">编辑此地址</a></span>
          <label>
            <input class="mr5" type="radio" name="csn_id" value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>" />
            <b class="mr10"><?php echo htmlspecialchars($v['receiver'], ENT_QUOTES, "UTF-8"); ?></b> <?php echo htmlspecialchars($v['area']['province'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['area']['city'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['area']['borough'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['address'], ENT_QUOTES, "UTF-8"); ?> <font class="c666 ml10">(联系电话：<?php echo htmlspecialchars($v['mobile'], ENT_QUOTES, "UTF-8"); ?>)</font>
          </label>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </ul>
      <div class="add-btn"><button type="button" class="sm-blue" id="newadrbtn">+ 新建收件人地址</button></div>
    </div>
    <div class="consignee-form cut hide" id="consignee-box">
      <form id="consignee-form">
        <input type="hidden" name="id" value="" />
        <dl><dt><label>收件人：</label></dt><dd><input name="receiver" type="text" class="w200 txt" /></dd></dl>
        <dl>
          <dt>收件地区：</dt>
          <dd>
            <select name="province" class="slt" id="areaslt-province" onchange="getAreaSelect('province')"><option value="">选择省份</option></select>
            <select name="city" class="slt" id="areaslt-city" onchange="getAreaSelect('city')"><option value="">选择城市</option></select>
            <select name="borough" class="slt" id="areaslt-borough"><option value="">选择区/县</option></select>
          </dd>
        </dl>
        <dl><dt>详细地址：</dt><dd><input name="address" id="address" type="text" class="w400 txt" /></dd></dl>
        <dl><dt>邮政编码：</dt><dd><input name="zip" type="text" class="w100 txt" /></dd></dl>
        <dl><dt>手机：</dt><dd><input name="mobile" type="text" class="w200 txt" /></dd></dl>
        <div class="consignee-btns mt10"><button type="button" class="sm-blue">保 存</button><span class="sep"></span><button type="reset" class="sm-gray">取 消</button></div>
      </form>
    </div>
  </div>
  <!-- 收件地址结束 -->
  <!-- 包裹清单开始 -->
  <div class="parcel cart odmod mt10">
    <div class="th cut">
      <h2 class="fl">包裹清单</h2>
      <div class="fr"><a title="返回购物车修改" href="<?php echo url(array('c'=>'cart', 'a'=>'index', ));?>"><i class="icon"></i></a></div>
    </div>
    <div class="module">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <th colspan="2">商品</th>
          <th width="130">价格(元)</th>
          <th width="130">数量</th>
          <th width="130">小计(元)</th>
        </tr>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cart['items']);?><?php foreach( $cart['items'] as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <tr>
          <td width="80"><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>" target="_blank"><img class="gim" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></td>
          <td>
            <div class="aln-l">
              <a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>" target="_blank"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a>
              <?php if (!empty($v['opts'])) : ?>
              <p class="opts c999 mt5"><?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['opts']);?><?php foreach( $v['opts'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?><span class="mr5">[<?php echo htmlspecialchars($vv['type'], ENT_QUOTES, "UTF-8"); ?>: <font class="c666"><?php echo htmlspecialchars($vv['opt_text'], ENT_QUOTES, "UTF-8"); ?></font>]</span><?php endforeach; ?></p>
              <?php endif; ?>
            </div>
          </td>
          <td><font class="unit-price"><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></font></td>
          <td><?php echo htmlspecialchars($v['qty'], ENT_QUOTES, "UTF-8"); ?></td>
          <td><?php echo htmlspecialchars($v['subtotal'], ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <div class="parcel-form module">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="aln-r" width="70"><b>留言备注：</b></td>
          <td class="aln-l"><textarea id="memos" cols="58" rows="3" placeholder="选填：内容不能超过240个字符"></textarea></td>
        </tr>
      </table>
    </div>
  </div>
  <!-- 包裹清单结束 -->
  <!-- 配送方式开始 -->
  <div class="odmod mt10 cut">
    <div class="th"><h2>配送方式</h2></div>
    <div class="selection module">
      <ul id="shipping_list">
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($shipping_method_list);?><?php foreach( $shipping_method_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <?php if ($_foreach_v_first == true) : ?>
        <li class="cur"><label><input checked="checked" class="mr5" type="radio" name="shipping_method" value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>" /><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></label><font class="ml10 c999"><?php echo htmlspecialchars($v['instruction'], ENT_QUOTES, "UTF-8"); ?></font></li>
        <?php else : ?>
        <li><label><input class="mr5" type="radio" name="shipping_method" value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>" /><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></label><font class="ml10 c999"><?php echo htmlspecialchars($v['instruction'], ENT_QUOTES, "UTF-8"); ?></font></li>
        <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <!-- 配送方式结束 -->
  <!-- 支付方式开始 -->
  <div class="odmod mt10 cut">
    <div class="th"><h2>支付方式</h2></div>
    <div class="selection module">
      <ul id="payment_list">
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($payment_method_list);?><?php foreach( $payment_method_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <?php if ($_foreach_v_first == true) : ?>
        <li class="cur"><label><input checked="checked" class="mr5" type="radio" name="payment_method" value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>" /><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></label><font class="ml10 c999"><?php echo htmlspecialchars($v['instruction'], ENT_QUOTES, "UTF-8"); ?></font></li>
        <?php else : ?>
        <li><label><input class="mr5" type="radio" name="payment_method" value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>" /><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></label><font class="ml10 c999"><?php echo htmlspecialchars($v['instruction'], ENT_QUOTES, "UTF-8"); ?></font>
          <?php if ($v['banklist']) : ?> 
          <div class="banklist" style="display: none;">
              <?php $_foreach_val_counter = 0; $_foreach_val_total = count($v['banklist']);?><?php foreach( $v['banklist'] as $key => $val ) : ?><?php $_foreach_val_index = $_foreach_val_counter;$_foreach_val_iteration = $_foreach_val_counter + 1;$_foreach_val_first = ($_foreach_val_counter == 0);$_foreach_val_last = ($_foreach_val_counter == $_foreach_val_total - 1);$_foreach_val_counter++;?>
              <div class="kd151">
              <div class="kd_img"><a href="#" target="_blank" title="<?php echo htmlspecialchars($val[1], ENT_QUOTES, "UTF-8"); ?>"><img src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/<?php echo htmlspecialchars($val[1], ENT_QUOTES, "UTF-8"); ?>.jpg" alt="<?php echo htmlspecialchars($val[1], ENT_QUOTES, "UTF-8"); ?>"></a></div>
              <?php if ($key == 0) : ?>
              <input type="radio" name="bank" value="<?php echo htmlspecialchars($val[0], ENT_QUOTES, "UTF-8"); ?>" checked />
              <?php else : ?>
              <input type="radio" name="bank" value="<?php echo htmlspecialchars($val[0], ENT_QUOTES, "UTF-8"); ?>" />
              <?php endif; ?>
              </div>
              <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
    
  <!-- 支付方式结束 -->
  <!-- 费用总计开始 -->
  <div class="total mt10 cut">
    <div class="th"><h2>订单合计</h2></div>
    <div class="module mt10 cut">
      <dl>
        <dt>商品合计：</dt>
        <dd><i>¥</i><font id="goods_amount"><?php echo htmlspecialchars($cart['amount'], ENT_QUOTES, "UTF-8"); ?></font></dd>
      </dl>
      <dl>
        <dt>运费合计：</dt>
        <dd><i>¥</i><font id="shipping_amount">0.00</font></dd>
      </dl>
      <dl>
        <dt>应付款金额总计：</dt>
        <dd class="count"><i>¥</i><font id="order_amount"><?php echo htmlspecialchars($cart['amount'], ENT_QUOTES, "UTF-8"); ?></font></dd>
      </dl>
    </div>
  </div>
  <!-- 费用总计结束 -->
  <form method="post" id="order-form" action="<?php echo url(array('c'=>'order', 'a'=>'submit', ));?>">
    <input type="hidden" name="csn_id" data-error="请选择一个收件人地址！" />
    <input type="hidden" name="shipping_id" data-error="请选择一个配送方式！" />
    <input type="hidden" name="payment_id" data-error="请选择一个支付方式！" />
    <input type="hidden" name="memos" />
    <input type="hidden" name="banklist" data-error="请选择一个银行" />
    <div class="aln-c mt20"><a class="checkout-btn" onclick="submitOrder()">确认并提交订单</a></div>
  </form>
</div>
<!-- 主体结束 -->
<div class="cl"></div>
<!-- 页脚开始 -->
<?php echo layout_footer();?>
<!-- 页脚结束 -->
<script type="text/template" id="consignee-row-tpl">
<li class="cur">
  <span class="c999 fr"><a onclick="editConsignee(this)">编辑此地址</a></span>
  <label>
    <input class="mr5" type="radio" name="csn_id" value="${id}" checked="checked" /> 
    <b class="mr10">${receiver}</b>${province} ${city} ${borough} ${address}
    <font class="c666 ml10">(联系电话：${mobile})</font>
  </label>
</li>
</script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
</body>
</html>