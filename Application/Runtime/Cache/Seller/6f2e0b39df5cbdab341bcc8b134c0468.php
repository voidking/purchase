<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/purchase/Public/css/sccl-seller.css">
    <link rel="stylesheet" type="text/css" href="/purchase/Public/css/skin/blue/skin.css" id="layout-skin"/>
    <link rel="stylesheet" href="/purchase/Public/libs/iconfont/iconfont.css">
    <title>商家控制台</title>
</head>
<body>
    <div class="layout-admin">
        <header class="layout-header">
            <span class="header-logo">商家控制台</span> 
            <a class="header-menu-btn" href="javascript:;"><i class="icon-font">&#xe600;</i></a>
            <ul class="header-bar">
                <li class="header-bar-nav">
                    <a href="javascript:;"><?php echo ($seller["username"]); ?><i class="icon-font" style="margin-left:5px;">&#xe60c;</i></a>
                    <ul class="header-dropdown-menu">
                        <li class="info"><a href="javascript:;">个人信息</a></li>
                        <li class="logout"><a href="javascript:;">退出</a></li>
                    </ul>
                </li>
                <li class="header-bar-nav"> 
                    <a href="javascript:;" title="换肤"><i class="icon-font">&#xe608;</i></a>
                    <ul class="header-dropdown-menu right dropdown-skin">
                        <li><a href="javascript:;" data-val="qingxin" title="清新">清新</a></li>
                        <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                        <li><a href="javascript:;" data-val="molv" title="墨绿">墨绿</a></li>
                        
                    </ul>
                </li>
            </ul>
        </header>
        <aside class="layout-side">
            <ul class="side-menu">
              
            </ul>
        </aside>
        
        <div class="layout-side-arrow"><div class="layout-side-arrow-icon"><i class="icon-font">&#xe60d;</i></div></div>
        
        <section class="layout-main">
            <div class="layout-main-tab">
                <button class="tab-btn btn-left"><i class="icon-font">&#xe60e;</i></button>
                <nav class="tab-nav">
                    <div class="tab-nav-content">
                        <a href="javascript:;" class="content-tab active" data-id="home.html">系统说明</a>
                    </div>
                </nav>
                <button class="tab-btn btn-right"><i class="icon-font">&#xe60f;</i></button>
            </div>
            <div class="layout-main-body">
                <iframe class="body-iframe" name="iframe0" width="100%" height="99%" src="home.html" frameborder="0" data-id="home.html" seamless></iframe>
            </div>
        </section>
    </div>
<input type="hidden" id="appPath" value="/purchase/index.php">
<input type="hidden" id="pubPath" value="/purchase/Public">
<div class="info-pane">
    <div class="col-lg-12 box">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" placeholder="用户名" disabled="true" value="<?php echo ($seller["username"]); ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="nickname" class="col-sm-2 control-label">昵称</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nickname" placeholder="昵称" value="<?php echo ($seller["seller_name"]); ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" placeholder="邮箱" value="<?php echo ($seller["email"]); ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="tel" class="col-sm-2 control-label">手机</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tel" placeholder="手机" value="<?php echo ($seller["tel"]); ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button id="updateInfo" type="button" class="btn btn-default">修改资料</button>
            </div>
          </div>
        </form>
    </div>

    <div class="col-lg-12 box">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="old-password" class="col-sm-2 control-label">原密码</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="old-password" placeholder="******">
            </div>
          </div>
          <div class="form-group">
            <label for="new-password" class="col-sm-2 control-label">新密码</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="new-password" >
            </div>
          </div>
          <div class="form-group">
            <label for="new-password2" class="col-sm-2 control-label">重复新密码</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="new-password2" >
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button id="updataPwd" type="button" class="btn btn-default">修改密码</button>
            </div>
          </div>
        </form>
    </div>

</div>
<script src="/purchase/Public/libs/jquery/jquery.min.js"></script>
<script src="/purchase/Public/libs/layer/layer.js"></script>
<script src="/purchase/Public/libs/art-template/dist/template.js"></script>
<script src="/purchase/Public/js/sccl-seller.js"></script>
<script src="/purchase/Public/js/sccl-util.js"></script>
<script>
$(function(){
    $('.logout').click(function(){
        var appPath = $('#appPath').val();
        $.ajax({
            url: appPath+'/Seller/User/logout',
            type: 'POST',
            dataType: 'json',
            data: {},
            success: function(data){
                console.log(data);
                if(data.code == '0'){
                    layer.msg('成功退出！');
                    setTimeout(function(){
                        window.location.href = appPath + '/Seller/User';
                    },1500);
                }else{
                    layer.msg(data.ext);
                }
                
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    });

    $('.info').click(function(){
        window.index = layer.open({
          type: 1,
          title: '个人信息',
          skin: 'layui-layer-rim', //加上边框
          area: ['600px', '520px'], //宽高
          content: $('.info-pane')
        });
        
    });

    $('#updateInfo').click(function(event) {

        var data = {
            seller_name: $('#nickname').val(),
            email: $('#email').val(),
            tel: $('#tel').val()
        };
        var appPath = $('#appPath').val();
        $.ajax({
            url: appPath+'/Seller/Manage/update_info',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data){
                console.log(data);
                if(data.code == 0){
                    layer.msg('修改成功！');
                    layer.close(window.index);
                }else{
                    layer.msg(data.ext);
                }
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    });

    $('#updataPwd').click(function(){
        var data = {
            old_password: $('#old-password').val(),
            new_password: $('#new-password').val(),
            new_password2: $('#new-password2').val()
        };
        var appPath = $('#appPath').val();
        $.ajax({
            url: appPath+'/Seller/Manage/update_pwd',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data){
                console.log(data);
                if(data.code == 0){
                    layer.msg('修改成功！');
                    layer.close(window.index);
                }else{
                    layer.msg(data.ext);
                }
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    });
});

</script>
</body>
</html>