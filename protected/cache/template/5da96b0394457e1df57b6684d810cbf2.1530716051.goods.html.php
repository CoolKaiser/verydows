<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verydows-baseurl" content="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($goods['meta_keywords'], ENT_QUOTES, "UTF-8"); ?>" />
<meta name="description" content="<?php echo htmlspecialchars($goods['meta_description'], ENT_QUOTES, "UTF-8"); ?>" />
<title><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?> - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/goods.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/jquery.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/jquery.zoom.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/general.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/goods.js"></script>
<script type="text/javascript">
$(function(){
  showReviewList(1);
  $('#contabs li').eq(2).on('click', function(){
    var container = $('#rating-satis'), move = parseFloat(container.find('dt').text()) * 100 - 14;
    container.animate({'padding-left': move}, 1000);
  });
});

function addFavorite(id){
  $.getJSON("<?php echo url(array('c'=>'api/favorite', 'a'=>'add', ));?>", {goods_id:id}, function(res){
    if(res.status == 'success'){
      $.vdsPopDialog({text: '加入收藏夹成功'});
    }else if(res.status == 'unlogined'){
      popLoginbar();
    }else{
      $.vdsPopDialog({type: 'err', text: '加入收藏夹失败'});
    }
  });
}

function showReviewList(page_id){
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: "<?php echo url(array('c'=>'api/goods', 'a'=>'reviews', 'goods_id'=>$goods['goods_id'], ));?>",
    data: {page:page_id},
    success: function(res){
      $('#reviews').empty();
      if(res.status == 'success'){
        $('#reviews').append(juicer($('#review-tpl').html(), res));
        if(res.paging != null) $('#reviews').append(juicer($('#review-paging-tpl').html(), res));
      }
      else{
        $('#reviews').append('<p class="aln-c c999">暂无评价...</p>');
      }
    }
  });
}

function reviewPageTurn(page_id){showReviewList(page_id);}
function reviewPageJump(e){showReviewList($(e).prev('input').val())}
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
  <div>
    <a href="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">网站首页</a>
    <b>&gt;</b>
    <?php $_foreach_v_counter = 0; $_foreach_v_total = count($breadcrumbs);?><?php foreach( $breadcrumbs as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
    <a href="<?php echo url(array('c'=>'category', 'a'=>'index', 'id'=>$v['cate_id'], ));?>"><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a>
    <b>&gt;</b>
    <?php endforeach; ?>
    <font><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?></font>
  </div>
</div>
<!-- 主体开始 -->
<div class="container w1100 mt10">
  <div class="gtds cut">
    <div class="gimbox fl">
      <!-- 商品图片开始 -->
      <div class="module">
        <div class="im cut">
          <div id="goods-imgarea"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/350x350/<?php echo htmlspecialchars($goods['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></div>
          <ul class="hide" id="goods-imgsrc">
            <li data-zoom="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/0/<?php echo htmlspecialchars($goods['goods_image'], ENT_QUOTES, "UTF-8"); ?>"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/350x350/<?php echo htmlspecialchars($goods['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></li>
            <?php if (!empty($album_list)) : ?>
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($album_list);?><?php foreach( $album_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <li data-zoom="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/album/0/<?php echo htmlspecialchars($v['image'], ENT_QUOTES, "UTF-8"); ?>"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/album/350x350/<?php echo htmlspecialchars($v['image'], ENT_QUOTES, "UTF-8"); ?>" /></li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
          <i class="zoom icon"></i> </div>
        <div class="tmb mt10 cut">
          <a class="tmb-arrow lh disabled" id="tmb-back-btn"><i class="icon">&lt;</i></a>
          <div class="tmb-im cut">
            <div class="module cut" id="thumb-container">
              <a class="cur"><img alt="<?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($goods['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a>
              <?php if (!empty($album_list)) : ?>
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($album_list);?><?php foreach( $album_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <a><img alt="<?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/album/50x50/<?php echo htmlspecialchars($v['image'], ENT_QUOTES, "UTF-8"); ?>" /></a>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
          <a class="tmb-arrow rh disabled" id="tmb-forward-btn"><i class="icon">&gt;</i></a>
        </div>
      </div>
      <!-- 商品图片结束 -->
      <div class="social mt20"><a onclick="addFavorite(<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>)"><i class="favor icon"></i><font>收藏</font></a></div>
    </div>
    <div class="gtbox cut">
      <h1><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?></h1>
      <p class="mt8 c888"><?php echo $goods['goods_brief']; ?></p>
      <div class="gatt module mt10 cut">
        <dl>
          <dt>商品货号:</dt>
          <dd><?php echo htmlspecialchars($goods['goods_sn'], ENT_QUOTES, "UTF-8"); ?></dd>
        </dl>
        <?php if ($goods['original_price'] > 0) : ?>
        <dl class="mt5">
          <dt>原<span class="sep-24"></span>价:</dt>
          <dd class="opri"><i>¥</i><?php echo htmlspecialchars($goods['original_price'], ENT_QUOTES, "UTF-8"); ?></dd>
        </dl>
        <?php endif; ?>
        <dl class="mt5">
          <dt>今日售价:</dt>
          <dd class="npri"><i>¥</i><font id="nowprice" data-price="<?php echo htmlspecialchars($goods['now_price'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($goods['now_price'], ENT_QUOTES, "UTF-8"); ?></font></dd>
        </dl>
        <?php if (($GLOBALS['cfg']['show_goods_stock'])) : ?>
        <dl class="mt5">
          <dt>剩余库存:</dt>
          <dd><?php echo htmlspecialchars($goods['stock_qty'], ENT_QUOTES, "UTF-8"); ?><font class="ml5 c999">件</font></dd>
        </dl>
        <?php endif; ?>
      </div>
      <div class="cutline mt10"></div>
      <div class="gatt module">
        <?php if (!empty($opt_list)) : ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($opt_list);?><?php foreach( $opt_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <dl class="mt15">
          <dt><?php echo htmlspecialchars($v['type_name'], ENT_QUOTES, "UTF-8"); ?>:</dt>
          <dd class="opt" data-checked=""> <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['children']);?><?php foreach( $v['children'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?> <a data-key="<?php echo htmlspecialchars($vv['id'], ENT_QUOTES, "UTF-8"); ?>" data-price="<?php echo htmlspecialchars($vv['opt_price'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($vv['opt_text'], ENT_QUOTES, "UTF-8"); ?></a> <?php endforeach; ?> </dd>
        </dl>
        <?php endforeach; ?>
        <?php endif; ?>
        <form method="post" action="<?php echo url(array('c'=>'cart', 'a'=>'index', ));?>" id="buy-form">
        <dl class="mt15">
          <dt>购买数量:</dt>
          <dd class="qty" id="buy-qty">
            <button type="button">-</button><input name="qty" class="aln-c" type="text" value="1" data-stock="<?php echo htmlspecialchars($goods['stock_qty'], ENT_QUOTES, "UTF-8"); ?>" /><button type="button">+</button>
            <font class="c999 ml5">件</font>
          </dd>
        </dl>
        </form>
      </div>
      <div class="buy mt30"><a class="add-cart icon" onclick="addToCart(this, '<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>')">加入购物车</a><a class="buy-now icon" onclick="toBuy('<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>', '<?php echo url(array('c'=>'cart', 'a'=>'index', ));?>')">立即购买</a></div>
    </div>
  </div>
  <div class="module mt10 cut">
    <!-- 左边开始 -->
    <div class="w210 fl cut">
      <?php if (!empty($related)) : ?>
      <div class="sli mb10">
        <h2>相关推荐</h2>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($related);?><?php foreach( $related as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <dl>
          <dt><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/150x150/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></dt>
          <dd class="lt mt5">
            <a title="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a>
            <p><i>¥</i><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
          </dd>
        </dl>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php if (!empty($bestseller)) : ?>
      <div class="sli mb10">
        <h2>热销榜</h2>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($bestseller);?><?php foreach( $bestseller as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <dl>
          <dt><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/150x150/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></dt>
          <dd class="lt mt5">
            <a title="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a>
            <p><i>¥</i><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
          </dd>
          <dd class="ct mt5">已售出<b><?php echo htmlspecialchars($v['count'], ENT_QUOTES, "UTF-8"); ?></b>件</dd>
        </dl>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
    <!-- 左边结束 -->
    <!-- 详情开始 -->
    <div class="details cut">
      <div class="tabs cut">
        <ul id="contabs">
          <li class="cur">商品介绍</li>
          <li>规格参数</li>
          <li>商品评价 (<font class="reviews-total"><?php echo htmlspecialchars($rating['total'], ENT_QUOTES, "UTF-8"); ?></font>)</li>
        </ul>
      </div>
      <div class="content"><?php echo $goods['goods_content']; ?></div>
      <!-- 规格参数开始 -->
      <div class="content hide">
        <div class="speci">
          <?php if (!empty($specs)) : ?>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($specs);?><?php foreach( $specs as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <tr>
              <th><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></th>
              <td><?php echo htmlspecialchars($v['value'], ENT_QUOTES, "UTF-8"); ?><?php echo htmlspecialchars($v['uom'], ENT_QUOTES, "UTF-8"); ?></td>
            </tr>
            <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
      <!-- 规格参数结束 -->
      <!-- 商品评论开始 -->
      <div class="content hide">
        <div class="synrating cut">
          <div class="rating fl cut"><font><?php echo htmlspecialchars($rating['avg'], ENT_QUOTES, "UTF-8"); ?></font> 分</div>
          <div class="satisficing cut">
            <dl id="rating-satis"><dt><?php echo htmlspecialchars($rating['avg'], ENT_QUOTES, "UTF-8"); ?></dt><dd>◆</dd></dl>
            <ul>
              <li class="col1">很不满意</li>
              <li class="col2">不满意</li>
              <li class="col3">一般</li>
              <li class="col4">满意</li>
              <li class="col5">非常满意</li>
            </ul>
            <p class="c888">该商品共累计评价 <strong class="reviews-total"><?php echo htmlspecialchars($rating['total'], ENT_QUOTES, "UTF-8"); ?></strong> 条</p>
          </div>
        </div>
        <div class="reviews module mt20 cut" id="reviews"></div>
      </div>
      <!-- 商品评论结束 -->
    </div>
    <!-- 详情结束 -->
  </div>
  <div class="cl"></div>
  <?php echo layout_helper();?> </div>
<!-- 主体结束 -->
<div class="cl"></div>
<!-- 页脚开始 -->
<?php echo layout_footer();?>
<!-- 页脚结束 -->
<!-- 评价模板开始 -->
<script type="text/template" id="review-tpl">
{@each list as v}
<dl>
  <dt><div class="avatar">{@if v.avatar != ''}<img width="60" height="60" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/user/avatar/${v.avatar}" />{@else}<i class="icon"></i>{@/if}</div><div class="uname">${v.username}</div></dt>
  <dd>
    <div><span class="rating s_${v.rating}"></span><font>${v.satisficing}</font></div>
    <p class="mt10 c666">${v.content}</p>
    <p class="mt8 caaa aln-r">${v.created_date}</p>
  </dd>
  {@if v.replied != ''}
  <dd class="replied mt10">
    <p class="c666"><strong>客服回复：</strong>${v.replied.content}</p>
    <p class="mt5 caaa aln-r">${v.replied.dateline}</p>
  </dd>
  {@/if}
</dl>
{@/each}
</script>
<!-- 评价模板结束 -->
<!-- 评价翻页模板开始 -->
<script type="text/template" id="review-paging-tpl">
<div class="module aln-r cut">
  <div class="paging small">
    {@if paging.first_page == paging.current_page}<span class="disabled">上一页</span>{@else}<a onclick="reviewPageTurn(${paging.prev_page})">上一页</a>{@/if}
    {@each paging.all_pages as v}
    {@if paging.current_page == v}<span class="cur">${paging.current_page}</span>{@else}<a onclick="reviewPageTurn(${v})">${v}</a>{@/if}
    {@/each}
    {@if paging.last_page == paging.current_page}<span class="disabled">下一页</span>{@else}<a onclick="reviewPageTurn(${paging.next_page})">下一页</a>{@/if}
    <span class="tot">共<b>${paging.total_page}</b>页</span>
    <span class="jump">转到第<input type="text" value="${paging.current_page}" />页<button type="button" onclick="reviewPageJump(this)">确 定</button></span>
  </div>
</div>
</script>
<!-- 评价翻页模板结束 -->
<!-- 加入购物车对话框开始 -->
<div class="tocart-dialog cut" id="tocart-dialog">
  <p><i class="icon"></i><font class="ml10"></font></p>
  <div class="mt20"><a class="sm-green" href="<?php echo url(array('c'=>'cart', 'a'=>'index', ));?>">结算付款</a><a class="sm-gray" onclick="cancelTocartDialog()">继续购物</a></div>
  <a class="c999" onclick="cancelTocartDialog()">×</a>
</div>
<!-- 加入购物车对话框结束 -->
<!-- 用户登陆框开始 -->
<?php echo layout_login(array('common'=>$common, ));?>
<!-- 用户登陆框结束 -->
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
</body>
</html>