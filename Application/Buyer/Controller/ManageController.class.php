<?php
namespace Buyer\Controller;

use Think\Controller;

require './Application/Util/Url.php';
require './Application/Util/Random.php';

class ManageController extends Controller
{
    // 项目默认方法
    public function index()
    {
        //echo get_script_url();   
        if(isset($_SESSION['buyer'])){
            $url = get_script_url().'/Buyer/Manage/manage_page';
            header("location: $url");
        }else{
            $url = get_script_url().'/Buyer/User/login_page';
            header("location: $url");
        }
    }

    public function manage_page(){
        if(!isset($_SESSION['buyer'])){
            $url = get_script_url().'/Buyer/User/login_page';
            header("location: $url");
        }

        $buyer = $_SESSION['buyer'];
        $this->assign('buyer',$buyer);
        $this->display();
    }

    public function create_ask_order(){
        $order_name = $_POST['order_name'];
        $product_arr = json_decode($_POST['product']);
        //echo json_encode($product_arr,JSON_UNESCAPED_UNICODE);
        
        $data['order_number'] = get_random_string(10);
        $data['buyer_id'] = $_SESSION['buyer']['id'];
        $data['order_name'] = $order_name;
        $data['product'] = json_encode($product_arr,JSON_UNESCAPED_UNICODE);

        $ask_order = M('ask_order');
        $success = $ask_order->add($data);
        if($success){
            $result['code'] = '0';
            $result['ext'] = '写入成功！';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
            $result['code'] = '1';
            $result['ext'] = '写入数据库失败！';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
        
    }

    public function find_ask_order_list_by_buyer_id(){
        $buyer_id = $_SESSION['buyer']['id'];

        $ask_order_model = M('ask_order');
        $ask_order_arr = $ask_order_model->where("buyer_id='$buyer_id'")->select();
        // foreach ($ask_order_arr as  &$ask_order) {
        //     $product_arr = json_decode($ask_order['product']);
        //     $ask_order['product'] = $product_arr;
        // }
        $result = array(
            'code' => '0',
            'ext' => 'succss',
            'ask_order_list' => $ask_order_arr
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    public function get_seller_list(){
        $seller_model = M('seller');
        $seller_arr = $seller_model->select();
        foreach ($seller_arr as &$seller) {
            $seller['password'] = '你猜';
        }
        $result = array(
            'code' => '0',
            'ext' => 'succss',
            'seller_list' => $seller_arr
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    public function create_reply_order(){
        $order_arr = json_decode($_POST['order_arr']);
        $seller_id_arr = $_POST['seller_id_arr'];
        
        $buyer_id = $_SESSION['buyer']['id'];

        $ask_order_model = M('ask_order');
        $data['asked'] = 1;
        foreach ($order_arr as $order) {
            $order_number = $order->order_number;
            $ask_order_model->where("order_number='$order_number'")->save($data);
            foreach ($seller_id_arr as $seller_id) {
                $dataList[] = array(
                    'order_number' => $order->order_number,
                    'buyer_id' => $buyer_id,
                    'seller_id' => $seller_id,
                    'order_name' => $order->order_name,
                    'product' => $order->product
                );
            }
        }

        $reply_order_model = M('reply_order');
        // foreach中的定义的变量，外部也可以调用！！！
        $success = $reply_order_model->addAll($dataList);

        if($success){
            $result['code'] = '0';
            $result['ext'] = '写入成功！';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
            $result['code'] = '1';
            $result['ext'] = '写入数据库失败！';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
        
    }

    // 查找已报价的报价单
    public function reply_order_list(){
        $buyer_id = $_SESSION['buyer']['id'];

        $ask_order_model = M('ask_order');
        $ask_order_arr = $ask_order_model->where("buyer_id='$buyer_id' AND asked=1 AND deleted=0")->select();

        $seller_model = M('seller');
        $reply_order_model = M('reply_order');
        $reply_order_arr = $reply_order_model->where("buyer_id='$buyer_id' AND deleted=0")->select();
        foreach ($reply_order_arr as  &$reply_order) {
            $product_reply = json_decode($reply_order['product_reply']);
            $reply_order['product_reply'] = $product_reply;
            $seller_id = $reply_order['seller_id'];
            $seller = $seller_model->where("id='$seller_id'")->find();
            $reply_order['seller'] = $seller;
        }

        $result = array(
            'code' => '0',
            'ext' => 'succss',
            'ask_order_list' => $ask_order_arr,
            'reply_order_list' => $reply_order_arr,
            'count_order_list' => $count_order_arr
        );

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    // 修改个人信息
    public function update_info(){
        $data['buyer_name'] = $_POST['buyer_name'];
        $data['email'] = $_POST['email'];
        $data['tel'] = $_POST['tel'];
        if($data['buyer_name'] == ''){
            $result = array(
                'code' => '1',
                'ext' => '昵称不能为空'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }

        $buyer_id = $_SESSION['buyer']['id'];

        $buyer_model = M('buyer');
        $success = $buyer_model->where("id='$buyer_id'")->save($data);
        if($success){
            $_SESSION['buyer']['buyer_name'] = $data['buyer_name'];
            $_SESSION['buyer']['email'] = $data['email'];
            $_SESSION['buyer']['tel'] = $data['tel'];
            $result = array(
                'code' => '0',
                'ext' => 'succss'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
            $result = array(
                'code' => '2',
                'ext' => '写入数据库失败！'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }

    // 修改密码
    public function update_pwd(){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $new_password2 = $_POST['new_password2'];

        if($old_password == '' || $new_password == '' || $new_password2 == ''){
            $result = array(
                'code' => '1',
                'ext' => '密码不能为空！'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }

        if($new_password != $new_password2){
            $result = array(
                'code' => '2',
                'ext' => '两次输入密码不一致！'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }

        if($_SESSION['buyer']['password'] == $old_password){
            $buyer_model = M('buyer');
            $data['password'] = $new_password;
            $buyer_id = $_SESSION['buyer']['id'];
            $success = $buyer_model->where("id='$buyer_id'")->save($data);
            if($success){
                $_SESSION['buyer']['password'] = $new_password;
                $result = array(
                    'code' => '0',
                    'ext' => 'succss'
                );
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }else{
                $result = array(
                    'code' => '3',
                    'ext' => '写入数据库失败！'
                );
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
        }else{
            $result = array(
                'code' => '4',
                'ext' => '原密码错误！'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }
}