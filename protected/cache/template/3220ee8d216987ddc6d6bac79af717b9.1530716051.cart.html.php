<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<meta name="keywords" content="购物车, 购物篮, 购物清单" />
<meta name="description" content="我的购物车" />
<title>我的购物车 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/order.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/cart.js"></script>
<script type="text/javascript">
$(function(){
  showCartList("<?php echo url(array('c'=>'api/cart', 'a'=>'list', ));?>");
});

function checkout(){
  var cart = {}, target = "<?php echo url(array('c'=>'order', 'a'=>'confirm', ));?>";
  $('#cart .cart-row').each(function(){
    var $item = $(this).data('json');
    $item.qty = $(this).find('.qty input').val();
    cart[$(this).data('key')] = $item;
  });
  setCookie('CARTS', JSON.stringify(cart), 604800);
  if(getCookie('LOGINED_USER') == null){
    popLoginbar(function(){window.location.href = target});  
  }else{
    window.location.href = target;
  }
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
    <div class="logo fl"><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>"><img src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/logo.gif" /></a></div>
    <div class="step cut"><ul><li class="cur">我的购物车</li><li>填写订单</li><li>完成付款</li></ul></div>
  </div>
</div>
<!-- 头部结束 -->
<!-- 主体开始 -->
<div class="container w1100 mt30">
  <div class="module cut" id="cart"></div>
</div>
<!-- 主体结束 -->
<div class="cl"></div>
<!-- 页脚开始 -->
<?php echo layout_footer();?>
<!-- 页脚结束 -->
<script type="text/template" id="cart-tpl">
  <div class="cart">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th colspan="2">商品</th>
        <th width="130">价格(元)</th>
        <th width="150">数量</th>
        <th width="130">小计(元)</th>
        <th width="130">操作</th>
      </tr>
      {@each items as v, k}
      <tr class="cart-row" data-key="${k}" data-json="${v.json}">
        <td width="80"><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>'${v.goods_id}', ));?>" target="_blank"><img class="gim" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/${v.goods_image}" /></a></td>
        <td>
          <div class="aln-l">
            <a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>'${v.goods_id}', ));?>" target="_blank">${v.goods_name}</a>
            {@if v.opts}<p class="opts c999 mt5">{@each v.opts as o}<span class="mr5">[${o.type}: <font>${o.opt_text}</font>]</span>{@/each}</p>{@/if}
          </div>
        </td>
        <td><font class="unit-price">${v.now_price} </font></td>
        <td class="qty"><button type="button">-</button><input class="aln-c" type="text" value="${v.qty}" data-stock="${v.stock_qty}" /><button type="button">+</button></td>
        <td><font class="subtotal red">${v.subtotal}</font></td>
        <td><a class="remove-row">删除</a></td>
      </tr>
      {@/each}
    </table>
  </div>
  <div class="module mt15 cut">
    <div class="clear-cart fl"><a onclick="clearCart(this)"><i class="icon"></i>清空购物车</a></div>
    <div class="cart-bill fr cut">
      <dl class="tot">
        <dt>您的购物车中有 <b id="item-count">${kinds}</b> 种商品，共计(不含运费)：</dt>
        <dd><b class="red">¥</b><font class="red" id="total">${amount}</font></dd>
      </dl>
      <div class="aln-r mt20"><a class="checkout-btn radius4" id="checkout-btn" onclick="checkout()">去结算</a></div>
    </div>
  </div>
</script>
<script type="text/template" id="nodata-tpl">
<div class="cart-empty cut"><p class="c666">您的购物车是空的！<a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">快去逛一逛</a>，找到您喜欢的商品放进购物车吧。</p></div>
</script>
<!-- 用户登陆框开始 -->
<?php echo layout_login(array('common'=>$common, ));?>
<!-- 用户登陆框结束 -->
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
</body>
</html>