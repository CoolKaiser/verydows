<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/list.js"></script>
<script type="text/javascript">
$(function(){searchRes(1)});
//搜索商品
function searchRes(page_id){
  var dataset = {
    cate_id: $('#cate_id').val(),
    brand_id: $('#brand_id').val(),
    sign_id: $('#sign_id').val(),
    status: $('#status').val(),
    kw: $('#kw').val(),
    sort_id: $('#sort_id').val(),
    page: page_id,
    pernum: 12,
  };
  $.asynList("<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'index', 'step'=>'search', ));?>", dataset, function(data){
    if(data.status == 'success'){
      juicer.register('format_date', function(v){return formatTimestamp(v, 'y-m-d<br />h:i:s');});
      $('#rows').append(juicer($('#table-tpl').html(), data));
      $('#rows tr').vdsRowHover();
      $('#rows tr:even').addClass('even');
      if(data.paging != null) $('#rows').append(juicer($('#paging-tpl').html(), data));
    }else{
      $('#rows').append("<div class='nors mt5'>未找到相关数据记录...</div>");
    }
  });
}
//翻页
function pageturn(page_id){searchRes(page_id);}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>商品列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae add btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'add', ));?>"><i></i><font>添加新商品</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'edit', ));?>', 'id')"><i class="edit"></i><font>编辑商品</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_review', 'a'=>'index', ));?>', 'id', 'goods_id')"><i class="cmt"></i><font>评价记录</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'edit', 'step'=>'attr', ));?>', 'id')"><i class="tag"></i><font>属性规格</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'edit', 'step'=>'related', ));?>', 'id')"><i class="link"></i><font>关联商品</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'delete', ));?>', 'id')"><i class="remove"></i><font>删除商品</font></a>
    </div>
    <div class="stools mt5">
      <select id="cate_id" class="slt">
        <option value="" selected="selected">全部分类</option>
        <?php if (!empty($cate_list)) : ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo str_repeat('|— ',$v['lv']);?> <?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <select id="brand_id" class="slt">
        <option value="" selected="selected">全部品牌</option>
        <?php if (!empty($brand_list)) : ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($brand_list);?><?php foreach( $brand_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($v['brand_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['brand_name'], ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <select id="sign_id" class="slt">
        <option value="" selected="selected">全部标记</option>
        <option value="0">新品</option>
        <option value="1">推荐</option>
        <option value="2">特价</option>
      </select>
      <select id="status" class="slt">
        <option value="" selected="selected">全部状态</option>
        <option value="1">上架</option>
        <option value="0">下架</option>
      </select>
      <select id="sort_id" class="slt">
        <option value="0">默认排序</option>
        <option value="1">时间倒序</option>
        <option value="2">时间升序</option>
        <option value="3">价格倒序</option>
        <option value="4">价格升序</option>
      </select>
      <input type="text" class="w300 txt" id="kw" placeholder="输入商品名称关键词" />
      <button type="button" class="sbtn btn" onclick="searchRes(1)">搜 索</button>
    </div>
    <div class="module mt5" id="rows"></div>
  </div>
</div>
<script type="text/template" id="table-tpl">
<table class="datalist">
  <tr>
    <th width="60" colspan="2">编号</th>
    <th class="ta-l">商品名称</th>
    <th width="150">货号</th>
    <th width="130">价格 <font class='c999'>(元)</font></th>
    <th width="100">库存</th>
    <th width="100">状态</th>
    <th width="100">创建时间</th>
  </tr>
  {@each list as v}
  <tr>
    <td width="20"><input name="id" type="checkbox" value="${v.goods_id}" /></td>
    <td width="40">${v.goods_id}</td>
    <td class="ta-l">
      <a class="blue" href="index.php?m=<?php echo htmlspecialchars($MOD, ENT_QUOTES, "UTF-8"); ?>&c=goods&a=edit&id=${v.goods_id}">${v.goods_name}</a>
      {@if v.newarrival == 1}<span class="sign">新品</span>{@/if}
      {@if v.recommend == 1}<span class="sign">推荐</span>{@/if}
      {@if v.bargain == 1}<span class="sign">特价</span>{@/if}
    </td>
    <td>${v.goods_sn}</td>
    <td class="red">${v.now_price}</td>
    <td>${v.stock_qty}</td>
    <td>{@if v.status == 1}<font class="green">上架</font>{@else}<font class="red">下架</font>{@/if}</td>
    <td class="c888">$${v.created_date|format_date}</td>
  </tr>
  {@/each}
</table>
</script>
<?php include $_view_obj->compile('backend/lib/paging.html'); ?>
<script type="text/javascript" src="public/script/juicer.js"></script>
</body>
</html>