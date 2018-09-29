<?php if(!class_exists("View", false)) exit("no direct access allowed");?><?php if (!empty($catebar)) : ?>
<ul id="catebar">
  <?php $_foreach_v_counter = 0; $_foreach_v_total = count($catebar);?><?php foreach( $catebar as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
  <?php if (!empty($v['children'])) : ?>
  <li class="haschild">
    <b>&gt;</b><a href="<?php echo url(array('c'=>'category', 'a'=>'index', 'id'=>$v['cate_id'], ));?>"><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a>
    <div><?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['children']);?><?php foreach( $v['children'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?><a href="<?php echo url(array('c'=>'category', 'a'=>'index', 'id'=>$vv['cate_id'], ));?>"><?php echo htmlspecialchars($vv['cate_name'], ENT_QUOTES, "UTF-8"); ?></a><?php endforeach; ?></div>
  </li>
  <?php else : ?>
  <li><a href="<?php echo url(array('c'=>'category', 'a'=>'index', 'id'=>$v['cate_id'], ));?>"><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a></li>
  <?php endif; ?>
  <?php endforeach; ?>
</ul>
<?php endif; ?>