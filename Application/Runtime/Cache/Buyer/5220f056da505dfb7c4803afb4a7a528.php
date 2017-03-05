<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="/purchase/Public/libs/bootstrap/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="/purchase/Public/css/new_ask_order.css">
    <title>创建询价单</title>
</head>
<body>
    <h2>新建询价单</h2>
    <form action="" class="product-form">
        <table class="product-table">
            <thead>
              <tr>
                <th>商品名称</th>
                <th>数量</th>
                <th>单位</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <!-- <tr class="show-tr">
                    <td class="product-name">毛巾</td>
                    <td class="product-num">5</td>
                    <td class="product-unit">条</td>
                    <td>
                        <span class="edit">修改</span>&nbsp;&nbsp;
                        <span class="delete">删除</span>
                    </td> 
                </tr> -->
                
                <!-- <tr class="input-tr">
                    <td class="product-name"><input type="text"></td>
                    <td class="product-num"><input type="text"></td>
                    <td class="product-unit">
                        <select>
                            <option value ="个">个</option>
                            <option value ="条">条</option>
                            <option value="盒">盒</option>
                            <option value="斤">斤</option>
                        </select>
                    </td>
                    <td>
                        <span class="confirm">确定</span>&nbsp;&nbsp;
                        <span class="delete">删除</span>
                    </td> 
                </tr> -->

                <tr class="add-tr">
                    <td colspan="4"><span class="add-item"></span></td>
                </tr>
            </tbody>
        </table>
        <div class="order-name">
            <label for="">询价单名称：</label>
            <input type="text">
        </div>
        
        <button type="submit" class="btn btn-primary submit">提交</button>
    </form>
    

<input type="hidden" id="appPath" value="/purchase/index.php">
<input type="hidden" id="pubPath" value="/purchase/Public">

<script type="text/html" id="input-tr">
    <tr class="input-tr">
        <td class="product-name"><input type="text" value="{{product_name}}"></td>
        <td class="product-num"><input type="text" value="{{product_num}}"></td>
        <td class="product-unit">
            <select>
                <option value ="个">个</option>
                <option value ="条">条</option>
                <option value="盒">盒</option>
                <option value="斤">斤</option>
            </select>
        </td>
        <td>
            <span class="confirm">确定</span>&nbsp;&nbsp;
            <span class="delete">删除</span>
        </td> 
    </tr>
</script>

<script type="text/html" id="finished-tr">
    <tr class="show-tr">
        <td class="product-name">{{product_name}}</td>
        <td class="product-num">{{product_num}}</td>
        <td class="product-unit">{{product_unit}}</td>
        <td>
            <span class="edit">修改</span>&nbsp;&nbsp;
            <span class="delete">删除</span>
        </td> 
    </tr>
</script>
<script src="/purchase/Public/libs/jquery/jquery.min.js"></script>
<script src="/purchase/Public/libs/layer/layer.js"></script>
<script src="/purchase/Public/libs/art-template/dist/template.js"></script>


<script>
$(function(){
    $('.product-form').on('click','.add-item',function(event) {
        $html = $(template('input-tr',{}));
        $html.insertBefore('.add-tr');
    });

    $('.product-form').on('click','.delete',function(){
        $tr = $(this).parents('tr');
        $tr.remove();
    });

    $('.product-form').on('click','.edit',function(){
        $tr = $(this).parents('tr');
        var data = {
            product_name: $tr.find('.product-name').html(),
            product_num: $tr.find('.product-num').html(),
            product_unit: $tr.find('.product-unit').html(),

        };
        $html = $(template('input-tr',data));
        $html.insertBefore($tr);
        $tr.remove();
    });

    $('.product-form').on('click','.confirm',function(){
        $tr = $(this).parents('tr');
        var data = {
            product_name: $tr.find('.product-name input').val(),
            product_num: $tr.find('.product-num input').val(),
            product_unit: $tr.find('.product-unit select').val(),
        };
        if(data.product_name == '' || data.product_num == ''){
            layer.msg('商品名称和数量不能为空！');
            return;
        }
        $html = $(template('finished-tr',data));
        $html.insertBefore($tr);
        $tr.remove();
    });

    $('.product-form').submit(function(event){
        event.preventDefault();
        
        
        $trs = $('.product-form .show-tr');
        if($trs.size() == 0){
            layer.msg('请至少添加一个商品');
            return;
        }

        var order_name = $('.order-name').find('input').val();
        if(order_name == ''){
            layer.msg('询价单名称不能为空');
            return;
        }
        var product = [];
        $trs.each( function(index, element) {
            var item = {
                product_name: $(element).find('.product-name').html(),
                product_num: $(element).find('.product-num').html(),
                product_unit: $(element).find('.product-unit').html(),

            };
            //console.log(item);
            product.push(item);
        });

        var data = {
            order_name: order_name,
            product: JSON.stringify(product)
        };

        console.log(data);
        var appPath = $('#appPath').val();
        $.ajax({
            url: appPath+'/Buyer/Manage/create_ask_order',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data){
                console.log(data);
                layer.msg('添加成功！');
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