<?php if(!class_exists("View", false)) exit("no direct access allowed");?><div class="header">
  <div class="w1100">
    <div class="module cut">
      <div class="logo fl"><a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>"><img alt="<?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/images/logo.gif" border="0" /></a></div>
      <!-- 头部搜索开始 -->
      <div class="top-search fl">
        <form method="get" action="<?php echo url(array('c'=>'search', 'a'=>'index', ));?>">
          <?php if ($GLOBALS['cfg']['rewrite_enable'] == 0) : ?><input type="hidden" name="c" value="search" /><input type="hidden" name="a" value="index" /><?php endif; ?>
          <div class="sf cut"><input class="fl" name="kw" type="text" value="" placeholder="双11提前购，畅想全年最低价" /><button class="fr" type="submit">搜 索</button></div>
        </form>
        <?php if (!empty($header['hot_searches'])) : ?>
        <div class="hw mt8">热门搜索：<?php $_foreach_v_counter = 0; $_foreach_v_total = count($hot_searches);?><?php foreach( $hot_searches as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?><a href="<?php echo url(array('c'=>'goods', 'a'=>'search', 'kw'=>$v, ));?>"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></a><?php endforeach; ?></div>
        <?php endif; ?>
      </div>
      <!-- 头部搜索结束 -->
      <!-- 头部购物车开始 -->
      <div class="top-cart fr">
        <div class="radius4 mt10"><i class="icon"></i><a href="<?php echo url(array('c'=>'cart', 'a'=>'index', ));?>" id="cartbar"><font>我的购物车</font>(<b>0</b>)</a></div>
      </div>
      <!-- 头部购物车结束 -->
    </div>
    <div class="module mt20">
      <!-- 导航开始 -->
      <div class="nav">
        <div class="cateth w210 fl" id="cateth">
          <h2>全部商品分类<i class="icon"></i></h2>
          <div class="catebar w210 hide"><?php echo layout_catebar();?></div>
        </div>
        <div class="cross cut">
          <ul>
            <li><a href="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>">首页</a></li>
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($nav);?><?php foreach( $nav as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <li><a href="<?php echo htmlspecialchars($v['link'], ENT_QUOTES, "UTF-8"); ?>" <?php echo $v['target']; ?>><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- 导航结束 -->
    </div>
  </div>
</div>