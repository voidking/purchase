<?php
namespace Buyer\Controller;

use Think\Controller;

require './Application/Util/Url.php';

class IndexController extends Controller
{
    // 项目默认方法
    public function index()
    {
        //echo get_script_url();   
        if(isset($_SESSION['buyer'])){
            $url = get_script_url().'/Buyer/Manage';
            header("location: $url");
        }else{
            $url = get_script_url().'/Buyer/User/login_page';
            header("location: $url");
        }
    }

}