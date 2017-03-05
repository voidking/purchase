<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="/purchase/Public/css/ask_order.css">
    <title>历史询价单</title>
</head>
<body>
    <h2>选择订单</h2>
    <table class="order-table">
        <thead>
          <tr>
            <th>询价单名称</th>
            <th>询价单号</th>
            <th>选择</th>
          </tr>
        </thead>
        <tbody class="order-tbody">
            <!-- <tr>
                <td class="order-name">东北师范大学</td>
                <td class="order-select">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                        </label>
                    </div>
                </td> 
            </tr> -->
        </tbody>
    </table>
    <h2>选择商家</h2>

    <table class="seller-table">
        <thead>
          <tr>
            <th>商家名称</th>
            <th>选择</th>
          </tr>
        </thead>
        <tbody class="seller-tbody">
            <!-- <tr>
                <td class="seller-name">东北师范大学</td>
                <td class="seller-select">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="1">
                        </label>
                    </div>
                </td> 
            </tr> -->
        </tbody>
    </table>
    <button class="submit">确认发送</button>

<input type="hidden" id="appPath" value="/purchase/index.php">
<input type="hidden" id="pubPath" value="/purchase/Public">

<script type="text/html" id="order-tr">
    {{each ask_order_list as ask_order}}
        <tr data-order-name="{{ask_order.order_name}}" data-product="{{ask_order.product}}">
            <td class="order-name">{{ask_order.order_name}}</td>
            <td class="order-number">{{ask_order.order_number}}</td>
            <td class="order-select">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="{{ask_order.order_number}}">
                    </label>
                </div>
            </td> 
        </tr>
    {{/each}}
</script>
<script type="text/html" id="seller-tr">
    {{each seller_list as seller}}
        <tr>
            <td class="seller-name">{{seller.seller_name}}</td>
            <td class="seller-select">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="{{seller.id}}">
                    </label>
                </div>
            </td> 
        </tr>
    {{/each}}
</script>
<script src="/purchase/Public/libs/jquery/jquery.min.js"></script>
<script src="/purchase/Public/libs/layer/layer.js"></script>
<script src="/purchase/Public/libs/art-template/dist/template.js"></script>


<script>
$(function(){
    var appPath = $('#appPath').val();
    // 初始化询价单列表
    $.ajax({
        url: appPath+'/Buyer/Manage/find_ask_order_list_by_buyer_id',
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

    // 初始化商家列表
    $.ajax({
        url: appPath+'/Buyer/Manage/get_seller_list',
        type: 'POST',
        dataType: 'json',
        data: {},
        success: function(data){
            console.log(data);
            $html = template('seller-tr',data);
            $('.seller-tbody').html($html);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });

    $('.submit').click(function(){
        var order_arr = [];
        $order_select_inputs = $('.order-select input:checked');
        $order_select_inputs.each(function(index, el) {
            var order_number = $(el).val();
            var order_name = $(el).parents('tr').attr('data-order-name');
            var product = $(el).parents('tr').attr('data-product');
            var item = {
                order_number: order_number,
                order_name: order_name,
                product: product
            };
            order_arr.push(item);
              
        });

        var seller_id_arr = [];
        $seller_select_inputs = $('.seller-select input:checked');
        $seller_select_inputs.each(function(index, el) {
            var seller_id = $(el).val();
            seller_id_arr.push(seller_id);
            
        });

        var data = {
            order_arr: JSON.stringify(order_arr),
            seller_id_arr: seller_id_arr
        };

        //console.log(data);
        $.ajax({
            url: appPath+'/Buyer/Manage/create_reply_order',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data){
                console.log(data);
                if(data.code == 0){
                    layer.msg('发送成功！');
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