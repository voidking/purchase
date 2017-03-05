<?php
namespace Seller\Controller;

use Think\Controller;

require './Application/Util/Url.php';
require './Application/Util/Random.php';

class ManageController extends Controller
{
    // 项目默认方法
    public function index()
    {
        //echo get_script_url();   
        if(isset($_SESSION['seller'])){
            $url = get_script_url().'/Seller/Manage/manage_page';
            header("location: $url");
        }else{
            $url = get_script_url().'/Seller/User/login_page';
            header("location: $url");
        }
    }

    public function manage_page(){
        if(!isset($_SESSION['seller'])){
            $url = get_script_url().'/Seller/User/login_page';
            header("location: $url");
        }

        $seller = $_SESSION['seller'];
        $this->assign('username',$seller['seller_name']);
        $this->display();
    }

    // 查找未报价的报价单
    public function find_reply_order_list_by_seller_id(){
        $seller_id = $_SESSION['seller']['id'];

        $reply_order_model = M('reply_order');
        $reply_order_arr = $reply_order_model->where("seller_id='$seller_id' AND replied=0 AND deleted=0")->select();
        foreach ($reply_order_arr as  &$reply_order) {
            $product_arr = json_decode($reply_order['product']);
            $reply_order['product'] = $product_arr;
        }
        $result = array(
            'code' => '0',
            'ext' => 'succss',
            'reply_order_list' => $reply_order_arr
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    // 查找报价单
    public function find_reply_order_by_id(){
        $id = $_POST['id'];

        $reply_order_model = M('reply_order');
        $reply_order = $reply_order_model->where("id='$id'")->find();
        $reply_order['product'] = json_decode($reply_order['product']);;
        $result = array(
            'code' => '0',
            'ext' => 'succss',
            'reply_order' => $reply_order
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);

    }

    // 商家报价
    public function update_reply_order(){
        $id = $_POST['id'];
        $product_reply_str = $_POST['product_reply'];
        $product_reply_arr = json_decode($product_reply);
        $total_price = $_POST['total_price'];

        $data['product_reply'] = $product_reply_str;
        $data['total_price'] = $total_price;
        $data['replied'] = 1;
        $reply_order_model = M('reply_order');
        $success = $reply_order_model->where("id='$id'")->save($data);
        if($success){
            $result = array(
                'code' => '0',
                'ext' => 'succss'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }

    // 查找已报价的报价单
    public function replied_order_list(){
        $seller_id = $_SESSION['seller']['id'];

        $reply_order_model = M('reply_order');
        $reply_order_arr = $reply_order_model->where("seller_id='$seller_id' AND replied=1 AND deleted=0")->select();
        foreach ($reply_order_arr as  &$reply_order) {
            $product_reply = json_decode($reply_order['product_reply']);
            $reply_order['product_reply'] = $product_reply;
        }
        $result = array(
            'code' => '0',
            'ext' => 'succss',
            'reply_order_list' => $reply_order_arr
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}