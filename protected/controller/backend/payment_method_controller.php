<?php
class payment_method_controller extends general_controller
{
    public function action_index()
    {
        $method_model = new payment_method_model();
        $this->type_map = $method_model->type_map;
        $this->results = $method_model->find_all(null, 'seq ASC');
        $this->compiler('payment/method_list.html');
    }

    public function action_add()
    {
        if(request('step') == 'submit')
        {
            $data = array
            (
                'name' => trim(request('name', '')),
                'type' => (int)request('type', 0),
                'pcode' =>  trim(request('pcode', '')),
                'instruction' => trim(request('instruction', '')),
                'params' => stripslashes(request('params', '')),
                'seq' => (int)request('seq', 99),
                'enable' => (int)request('enable', 0),
            );

            $method_model = new payment_method_model();
            $verifier = $method_model->verifier($data);
            if(TRUE === $verifier)
            {
                $method_model->create($data);
                $this->prompt('success', '添加支付方式成功', url($this->MOD.'/payment_method', 'index'));
            }
            else
            {
                $this->prompt('error', $verifier);
            }
        }
        else
        {
            //$area = new area();
            //$this->area_select = $area->get_children();
            $this->compiler('payment/add_payment.html');
        }
    }

    public function action_edit()
    {
        if(request('step') == 'submit')
        {
            $data = array
            (
                'instruction' => trim(request('instruction', '')),
                'params' => (array)request('params', array()),
                'seq' => (int)request('seq', 99),
                'enable' => (int)request('enable', 0),
            );

            $method_model = new payment_method_model();
            $verifier = $method_model->verifier($data);
            if(TRUE === $verifier)
            {
                $data['params'] = json_encode($data['params']);
                $method_model->update(array('id' => (int)request('id')), $data);
                $this->prompt('success', '更新支付方式成功', url($this->MOD.'/payment_method', 'index'));
            }
            else
            {
                $this->prompt('error', $verifier);
            }
        }
        else
        {
            $method_model = new payment_method_model();
            if($rs = $method_model->find(array('id' => (int)request('id'))))
            {
                if(file_exists(VIEW_DIR.DS.'backend'.DS.'payment'.DS.$rs['pcode'].'_config.html'))
                {
                    $rs['config_tpl'] = "backend/payment/{$rs['pcode']}_config.html";
                    $rs['params'] = json_decode($rs['params'], TRUE);
                }
                
                $this->rs = $rs;
                $this->type_map = $method_model->type_map;
                $this->compiler('payment/method.html');
            }
            else
            {
                $this->prompt('error', '未找到相应的数据记录');
            }
        }
    }

    public function action_delete()
    {
        $method_model = new payment_method_model();
        if($method_model->delete(array('id' => (int)request('id'))) > 0)
        {
            $this->prompt('success', '删除支付方式成功', url($this->MOD.'/payment_method', 'index'));
        }    
        else
        {
            $this->prompt('error', '删除支付方式失败');
        }    
    }
    
}