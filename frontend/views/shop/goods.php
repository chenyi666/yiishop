<div class="goodslist_wrap">
    <div>
        <ul>
            <?php foreach ($goods as $good):?>
                <li>
                    <dl>
                        <dt>
                            <a href="">
                         <?=\yii\helpers\Html::img(Yii::$app->params['adminPicUrl'].$good->logo)?>
                            </a>
                        </dt>
                        <dd><?=\yii\helpers\Html::a($good->name,['shop/good','id'=>$good->id])?></a></dd>
                        <dd><span>售价:</span><strong><?=$good->shop_price?></strong></dd>
                    </dl>
                </li>
            <?php endforeach;?>
        </ul>
    </div>


