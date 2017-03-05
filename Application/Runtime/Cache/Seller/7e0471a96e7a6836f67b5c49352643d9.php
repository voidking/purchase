<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="/purchase/Public/css/ask_order.css">
    <title>报价</title>
</head>
<body>
    <h2>报价单列表</h2>
    <table class="order-table">
        <thead>
          <tr>
            <th>报价单名称</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody class="order-tbody">
            <!-- <tr>
                <td class="order-name">东北师范大学</td>
                <td class="operation">
                    <span>查看</span>
                </td> 
            </tr> -->
        </tbody>
    </table>

<input type="hidden" id="appPath" value="/purchase/index.php">
<input type="hidden" id="pubPath" value="/purchase/Public">
<div class="pane" style="display: none;">
    <form action="" class="product-form">
        <table class="product-table">
            <thead>
              <tr>
                <th>商品名称</th>
                <th>数量</th>
                <th>单位</th>
                <th>价格/元</th>
              </tr>
            </thead>
            <tbody>
                <tr class="show-tr">
                    <td class="product-name">毛巾</td>
                    <td class="product-num">5</td>
                    <td class="product-unit">条</td>
                    <td class="product-price">
                        <input type="text">
                    </td> 
                </tr>
                
            </tbody>
        </table>
        
        <button type="submit" class="btn btn-primary submit">提交</button>
    </form>
</div>
<script type="text/html" id="order-tr">
    {{each res_order_list as res_order}}
        <tr data-product="{{res_order.product}}">
            <td class="order-name">{{res_order.order_name}}</td>
            <td class="operation">
                <span class="detail">报价</span>
            </td> 
        </tr>
    {{/each}}
</script>
<script src="/purchase/Public/libs/jquery/jquery.min.js"></script>
<script src="/purchase/Public/libs/layer/layer.js"></script>
<script src="/purchase/Public/libs/art-template/dist/template.js"></script>


<script>
$(function(){
    $('.order-table').on('click','.detail',function(){
        layer.open({
          type: 1,
          title: '报价',
          skin: 'layui-layer-rim', //加上边框
          area: ['500px', '500px'], //宽高
          content: $('.pane').html()
        });
    });
    var appPath = $('#appPath').val();
    // 初始化询价单列表
    $.ajax({
        url: appPath+'/Seller/Manage/find_res_order_list_by_seller_id',
        type: 'POST',
        dataType: 'json',
        data: {},
        success: function(data){
            console.log(data);
            $html = template('order-tr',data);
            $('.order-tbody').html($html);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
    
});    
</script>
</body>
</html>