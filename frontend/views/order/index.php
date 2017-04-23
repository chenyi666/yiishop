<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="fillin w990 bc mt15">
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>
    <form action="<?=\yii\helpers\Url::to(['order/add'])?>" method="post">
        <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->csrfToken?>">
    <div class="fillin_bd">
        <!-- 收货人信息  start-->
        <div class="address">
            <h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>
            <div class="address_info">
                <?php foreach ($addresses as $k=>$address):?>
                <p>
                    <input type="radio" value="<?=$address->id?>" name="Order[address_id]"/><?=$address->name.'    '.$address->tel.'   '.$address->province.'      '.$address->city.'    '.$address->area?></p>
            </div>
            <?php endforeach;?>

        </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start -->
        <div class="delivery">
            <h3>送货方式 <a href="javascript:;" id="delivery_modify">[修改]</a></h3>
            <div class="delivery_info">
                <p>普通快递送货上门</p>
                <p>送货时间不限</p>
            </div>

            <div class="delivery_select none">
                <table>
                    <thead>
                    <tr>
                        <th class="col1">送货方式</th>
                        <th class="col2">运费</th>
                        <th class="col3">运费标准</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (\frontend\models\Order::$deliveries as $k=>$delivery):?>
                    <tr class="cur">
                        <td>
                            <input type="radio" name="Order[deliveries_id]" value="<?=$k?>" checked="checked" /><?=$delivery[0]?>
                            <select name="" id="">
                                <option value="">时间不限</option>
                                <option value="">工作日，周一到周五</option>
                                <option value="">周六日及公众假期</option>
                            </select>
                        </td>
                        <td>￥<?=$delivery[1]?></td>
                        <td><?=$delivery[2]?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <a href="" class="confirm_btn"><span>确认送货方式</span></a>
            </div>
        </div>
        <!-- 配送方式 end -->

        <!-- 支付方式  start-->
        <div class="pay">
            <h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>
            <div class="pay_info">
                <p>货到付款</p>
            </div>

            <div class="pay_select none">
                <table>
                    <?php foreach (\frontend\models\Order::$payments as $k=>$payment):?>
                    <tr class="cur">
                        <td class="col1"><input type="radio" name="Order[pay_type_id]"  value="<?=$k;?>"/><?=$payment[0]?></td>
                        <td class="col2"><?=$payment[1]?></td>
                    </tr>
                    <?php endforeach;?>
                </table>
                <a href="" class="confirm_btn"><span>确认支付方式</span></a>
            </div>
        </div>
        <!-- 支付方式  end-->

        <!-- 发票信息 start-->
        <div class="receipt">
            <h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
            <div class="receipt_info">
                <p>个人发票</p>
                <p>内容：明细</p>
            </div>
        </div>
        <!-- 发票信息 end-->

        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                <tr>
                    <th class="col1">商品</th>
                    <th class="col3">价格</th>
                    <th class="col4">数量</th>
                    <th class="col5">小计</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($carts as $cart):?>
                <tr>
                    <td class="col1"><a href="">
                            <?=\yii\helpers\Html::img(Yii::$app->params['adminPicUrl'].$cart->goods->logo)?>
                            <strong><a href=""><?=$cart->goods->name?></a></strong></td>
                    <td class="col3">￥<?=$cart->goods->shop_price?></td>
                    <td class="col4"> <?=$cart->amount?></td>
                    <td class="col5"><span>￥<?=$cart->goods->shop_price*$cart->amount?></span></td>
                </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>
                                <span>4 件商品，总商品金额：</span>
                                <em>￥5316.00</em>
                            </li>
                            <li>
                                <span>返现：</span>
                                <em>-￥240.00</em>
                            </li>
                            <li>
                                <span>运费：</span>
                                <em>￥10.00</em>
                            </li>
                            <li>
                                <span>应付总额：</span>
                                <em>￥5076.00</em>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->

    </div>

    <div class="fillin_ft">

        <?=\yii\helpers\Html::a('<span>提交订单</span>',['order/add'])?>
        <input type="submit">
        <p>应付总额：<strong>￥5076.00元</strong></p>
    </div>
    </form>
</div>