<?php
/**
 * DCpay
 * @author Cigery
 */
include_once APP_DIR.DS.'plugin'.DS.'payment'.DS.'config.php';

class DCpay extends abstract_payment
{
    public function create_pay_url($args)
    {
        $apiversion = '3';
        $version = '11';
        $merchant_account = DCPAY_MERCHANTID;
        $merchant_order = $args['order_id'];
        $merchant_product_desc = 'deposit';
        $first_name = 'test';
        $last_name = 'test';
        $address1 = 'Address line 1';
        $city = 'Home city';
        $zip_code = '1000';
        $country = 'CN';
        $phone = '123456789';
        $email = 'test@qq.com';
        $amount = $args['order_amount'] * 100;
        $currency = 'CNY';
        $bankcode = $args['banklist'];
        $ipaddress = $_SERVER["REMOTE_ADDR"];
        $return_url = DCPAY_RETURN_URL;
        $server_return_url = DCPAY_NOTIFY_URL;
        $key = DCPAY_PRODUCTKEY;
        $signStr = $merchant_account.$amount.$currency.$first_name.$last_name.$address1.
                                $city.$zip_code.$country.$phone.$email.$merchant_order.$merchant_product_desc.$return_url;
        $control = hash_hmac('SHA1', $signStr, $key);
        $payUrl = DCPAY_QUERY_URL;

        $params = [
            'apiversion'    =>  $apiversion,
            'version'   =>  $version,
            'merchant_account'  =>  $merchant_account,
            'merchant_order'    =>  $merchant_order,
            'merchant_product_desc' =>  $merchant_product_desc,
            'first_name'    =>  $first_name,
            'last_name' =>  $last_name,
            'address1'  =>  $address1,
            'city'  =>  $city,
            'zip_code'  =>  $zip_code,
            'country'   => $country,
            'phone' => $phone,
            'email' =>  $email,
            'amount'    =>  $amount,
            'currency'  =>  $currency,
            'bankcode'  =>  $bankcode,
            'ipaddress' =>  $ipaddress,
            'return_url'    =>  $return_url,
            'server_return_url' =>  $server_return_url,
            'control'   =>  $control,
            'payUrl'    =>  $payUrl
        ];

        return $params;

    }
    
    public function response($args)
    {
        if($this->_verifier($args))
        {
            $order_model = new order_model();
            $this->order = $order_model->find(array('order_id' => $args['merchant_order']));
            if($args['status'] == 'A0')
            {
                $this->message = '付款成功！您可以在订单详情里关注您的订单状态';
                $this->completed($args['merchant_order'], $args['transactionid']);
                return TRUE;
            }
            else
            {
                $this->message = '支付失败';
            }
        }
        else
        {
            $this->message = '付款验证失败';
        }
        return FALSE;
    }
     
    private function _verifier($args)
    {
        $transactionid = $args['transactionid'];
        $merchant_order = $args['merchant_order'];
        $amount = $args['amount'];
        $currency = $args['currency'];
        $bankcode = $args['bankcode'];
        $bank_transactionid = $args['bank_transactionid'];
        $status = $args['status'];
        $message = $args['message'];
        $billingdescriptor = $args['billingdescriptor'];
        $first_name = $args['first_name'];
        $last_name = $args['last_name'];
        $control = $args['control'];
        $key = DCPAY_PRODUCTKEY;
        $signStr = $transactionid.$merchant_order.$amount.$currency.$bank_transactionid.$status;
	    $sign = hash_hmac('SHA1', $signStr, $key);
        
        if($sign == $control) return TRUE;
        return FALSE;
    }
}