<?php if(!class_exists("View", false)) exit("no direct access allowed");?><div class="menu">
  <h2>用户菜单</h2>
  <ul id="usermenu">
    <?php $_foreach_v_counter = 0; $_foreach_v_total = count($menu_list);?><?php foreach( $menu_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
    <?php if (@$_GET['c'] == $v['c'] && @$_GET['a'] == $v['a']) : ?>
    <li class="cur"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></li>
    <?php else : ?>
    <li><a href="<?php echo url(array('c'=>$v['c'], 'a'=>$v['a'], ));?>"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a></li>
    <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</div>