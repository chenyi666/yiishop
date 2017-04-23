<?php foreach ($models as $goods):?>
<tr>
    <td class="coll">

        <a href=""><?=\yii\helpers\Html::img(Yii::$app->params['adminPicUrl'].$goods['logo']);?></a>
        <strong><a href=""><?=$goods['name']?></a></strong>
    </td>
    <td class="col3">￥<span><?=$goods['shop_price']?></span></td>
    <td class="col4">
        <a href="javascript:;" class="reduce_num"></a>
        <input type="text" name="amount" value="<?=$goods['num']?>" class="amount"/>
        <a href="javascript:;" class="add_num"></a>
    </td>
    <td class="col5">￥<span><?=$goods['shop_price']*$goods['num']?></span></td>
    <td class="col6"><a href="javascript:;" class="btn_del" name="_csrf-frontend" value="<?=Yii::$app->request->csrfToken;?>">删除</a></td>
</tr>
<?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">购物金额总计： <strong>￥ <span id="total"></span></strong></td>
    </tr>
    </tfoot>
    </table>
    <div class="cart_btn w990 bc mt10">
        <a href="" class="continue">继续购物</a>
        <?=\yii\helpers\Html::a('结算',['order/index'],['class'=>'checkout'])?>
 <!--       <a href="" class="checkout">结 算</a>-->
    </div>
    </div>
<?php
/*$this->registerJs('totalPrice();');*/


