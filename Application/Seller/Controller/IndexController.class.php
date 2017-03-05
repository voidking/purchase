<?php
namespace Seller\Controller;

use Think\Controller;

require './Application/Util/Url.php';

class IndexController extends Controller
{
    // 项目默认方法
    public function index()
    {
        //echo get_script_url();   
        if(isset($_SESSION['seller'])){
            $url = get_script_url().'/Seller/Manage';
            header("location: $url");
        }else{
            $url = get_script_url().'/Seller/User/login_page';
            header("location: $url");
        }
    }

}