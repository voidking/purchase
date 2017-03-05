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
    <h2>未处理报价单</h2>
    <table class="order-table">
        <thead>
          <tr>
            <th>报价单名称</th>
            <th>报价单号</th>
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

<script type="text/html" id="order-form">
    <form action="" class="order-form">
        <table class="order-table">
            <thead>
              <tr>
                <th>商品名称</th>
                <th>数量</th>
                <th>单位</th>
                <th>价格/元</th>
              </tr>
            </thead>
            <tbody>
                {{each reply_order.product as item}}
                <tr class="product-tr">
                    <td class="product-name">{{item.product_name}}</td>
                    <td class="product-num">{{item.product_num}}</td>
                    <td class="product-unit">{{item.product_unit}}</td>
                    <td class="product-price">
                        <input type="text">
                    </td> 
                </tr>
                {{/each}}
            </tbody>
        </table>
        
        <button type="submit" class="btn btn-primary submit">确认报价</button>
    </form>
</script>

<script type="text/html" id="order-tr">
    {{each reply_order_list as reply_order}}
        <tr data-id="{{reply_order.id}}">
            <td class="order-name">{{reply_order.order_name}}</td>
            <td class="order-number">{{reply_order.order_number}}</td>
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
    // 初始化
    var appPath = $('#appPath').val();
    $.ajax({
        url: appPath+'/Seller/Manage/find_reply_order_list_by_seller_id',
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

    // 报价
    $('.order-table').on('click','.detail',function(){
        var $tr = $(this).parents('tr');
        var id = $tr.attr('data-id');
        $.ajax({
            url: appPath+'/Seller/Manage/find_reply_order_by_id',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                console.log(data);
                $html = template('order-form',data);

                var index = layer.open({
                  type: 1,
                  title: '报价',
                  skin: 'layui-layer-rim', //加上边框
                  area: ['500px', '500px'], //宽高
                  content: $html
                });

                $('.order-form').unbind().submit(function(event){
                    event.preventDefault();
                    $trs = $('.order-table .product-tr');

                    var flag = true;
                    var product_reply = [];
                    var total_price = 0;
                    $trs.each( function(index, element) {
                        var item = {
                            product_name: $(element).find('.product-name').html(),
                            product_num: $(element).find('.product-num').html(),
                            product_unit: $(element).find('.product-unit').html(),
                            product_price: $(element).find('.product-price input').val()
                        };
                        //console.log(item);
                        if(item.product_price == '' || isNaN(item.product_price)){
                            layer.msg('价格为空或格式错误');
                            flag = false;
                            return;
                        }
                        
                        product_reply.push(item);
                        total_price = total_price + Number(item.product_price);
                    });

                    if(flag == false){
                        return;
                    }
                    var data = {
                        id: id,
                        product_reply: JSON.stringify(product_reply),
                        total_price: total_price
                    };
                    $.ajax({
                        url: appPath+'/Seller/Manage/update_reply_order',
                        type: 'POST',
                        dataType: 'json',
                        data: data,
                        success: function(data){
                            console.log(data);
                            if(data.code == 0){
                                layer.msg('报价成功');
                                layer.close(index);
                                $tr.remove();
                            }
                        },
                        error: function(xhr){
                            console.log(xhr);
                        }
                    });

                });
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