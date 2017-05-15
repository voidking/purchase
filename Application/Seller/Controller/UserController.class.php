<?php
namespace Seller\Controller;

use Think\Controller;

require './Application/Util/Url.php';


class UserController extends Controller
{
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

    public function login_page(){
        $this->display();
    }


    // 登录函数
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == '' || $password == ''){
            $result = array(
                'code' => '2',
                'ext' => '用户名和密码不能为空'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }

        $seller = M('seller');
        $data = $seller->where("username='$username' AND password='$password'")->find();

        if($data){
            $_SESSION['seller']=$data;
            $result = array(
                'code' => '0',
                'ext' => '登录成功',
                'username' => $_SESSION['seller']['username']
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{            
            $result = array(
                'code' => '1',
                'ext' => '用户名或密码错误'                 
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }

    // 退出函数
    public function logout(){
        unset($_SESSION['seller']);
        $result = array(
            'code' => '0',
            'ext' => 'success'
        );
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    // 注册函数
    public function register(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        $result = array();
        if($username == '' || $password == '' || $repassword == ''){
            $result['code'] = '1';
            $result['ext'] = '用户名和密码不能为空';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }

        if($password != $repassword){
            $result['code'] = '2';
            $result['ext'] = '两次输入密码不一致';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }

        $Seller = M('seller');
        $data['username'] = $username;
        $data['password'] = $password;
        $data['seller_name'] = '一个商家';
        // if(!$Seller->create()){
        //     $this->error($Seller->getError());
        // }
        $success = $Seller->add($data);
        if($success){
            //$this->success('注册成功！',get_script_url().'/Seller/Manage');
            $result['code'] = '0';
            $result['ext'] = '注册成功！';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
            //$this->error('创建失败');
            $result['code'] = '3';
            $result['ext'] = '写入数据库失败！';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }
}