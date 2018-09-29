<?php if(!class_exists("View", false)) exit("no direct access allowed");?><div class="footer mt20">
  <div class="links radius4 mt20">
    <a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">首 页</a>|
    <a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>">触屏版</a>
    <?php if (!empty($nav)) : ?>
    |<?php $_foreach_v_counter = 0; $_foreach_v_total = count($nav);?><?php foreach( $nav as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?><a href="<?php echo htmlspecialchars($v['link'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a><?php if ($_foreach_v_iteration != $_foreach_v_total) : ?>|<?php endif; ?><?php endforeach; ?>
    <?php endif; ?>
  </div>
  <?php echo $footer; ?>
</div>