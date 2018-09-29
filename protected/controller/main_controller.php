<?php
class main_controller extends general_controller
{
    public function action_index()
    {
        if(is_mobile_device() && request('display') != 'pc') jump(url('mobile/main', 'index'));
        
        $vcache = vcache::instance();
        $goods_model = new goods_model();
        $adv_model = new adv_model();
        $goods_cate_model = new goods_cate_model();
        
        $this->nav = $vcache->nav_model('get_site_nav');

        $this->catebar = $goods_cate_model->goods_cate_bar();
        
        $this->hot_searches = explode(',', $GLOBALS['cfg']['goods_hot_searches']);

        // 轮播图
        $this->banner = $adv_model->query("SELECT name, codes FROM {$adv_model->table_name} where status = 1  ORDER BY seq DESC limit 5 ");
   
        $this->newarrival = $vcache->goods_model('find_goods', array(array('newarrival' => 1), 5), $GLOBALS['cfg']['data_cache_lifetime']);
        if(is_null($this->newarrival)){
            $this->newarrival = $goods_model->find_goods(array(array('newarrival' => 1), 5));
        }
        
        $this->recommend = $vcache->goods_model('find_goods', array(array('recommend' => 1), 20), $GLOBALS['cfg']['data_cache_lifetime']);
        if(is_null($this->recommend)){
            $this->recommend = $goods_model->find_goods(array(array('recommend' => 1), 20));
        }
        
        $this->bargain = $vcache->goods_model('find_goods', array(array('bargain' => 1), 5), $GLOBALS['cfg']['data_cache_lifetime']);
        
        $this->latest_article = $vcache->article_model('get_latest_article', array(4), $GLOBALS['cfg']['data_cache_lifetime']);
        
        $this->compiler('index.html');
    }
    
    public function action_404()
    {
        $this->compiler('404.html');
    }
}