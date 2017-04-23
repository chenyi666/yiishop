<h3><strong><?=$good->name?></strong></h3>

<div class="preview fl">
    <div class="midpic">
        <a href="<?php echo \yii\helpers\Html::img(Yii::$app->params['adminPicUrl'].$good->logo);?>" class="jqzoom" rel="gal1">
            <!-- 第一幅图片的大图 class 和 rel属性不能更改 -->
            <?=\yii\helpers\Html::img(Yii::$app->params['adminPicUrl'].$good->logo,['height'=>350,'width'=>350])?>             <!-- 第一幅图片的中图 -->
        </a>
    </div>

    <!--使用说明：此处的预览图效果有三种类型的图片，大图，中图，和小图，取得图片之后，分配到模板的时候，把第一幅图片分配到 上面的midpic 中，其中大图分配到 a 标签的href属性，中图分配到 img 的src上。 下面的smallpic 则表示小图区域，格式固定，在 a 标签的 rel属性中，分别指定了中图（smallimage）和大图（largeimage），img标签则显示小图，按此格式循环生成即可，但在第一个li上，要加上cur类，同时在第一个li 的a标签中，添加类 zoomThumbActive  -->

    <div class="smallpic">
        <a href="javascript:;" id="backward" class="off"></a>
        <a href="javascript:;" id="forward" class="on"></a>
        <div class="smallpic_wrap">
            <ul>
                <li class="cur">
                    <a class="zoomThumbActive" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m1.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l1.jpg'}"><img src="<?=Yii::getAlias('@web')?>/images/preview_s1.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m2.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l2.jpg'}"><img src="<?=Yii::getAlias('@web')?>/images/preview_s2.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                       rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m3.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l3.jpg'}">
                        <img src="<?=Yii::getAlias('@web')?>/images/preview_s3.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                       rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m4.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l4.jpg'}">
                        <img src="<?=Yii::getAlias('@web')?>/images/preview_s4.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                       rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m5.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l5.jpg'}">
                        <img src="<?=Yii::getAlias('@web')?>/images/preview_s5.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                       rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m6.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l6.jpg'}">
                        <img src="<?=Yii::getAlias('@web')?>/images/preview_s6.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                       rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m7.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l7.jpg'}">
                        <img src="<?=Yii::getAlias('@web')?>/images/preview_s7.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                       rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m8.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l8.jpg'}">
                        <img src="<?=Yii::getAlias('@web')?>/images/preview_s8.jpg"></a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                       rel="{gallery: 'gal1', smallimage: '<?=Yii::getAlias('@web')?>/images/preview_m9.jpg',largeimage: '<?=Yii::getAlias('@web')?>/images/preview_l9.jpg'}">
                        <img src="<?=Yii::getAlias('@web')?>/images/preview_s9.jpg"></a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="goodsinfo fl ml10">
    <ul>
        <li><span>商品编号： </span><?=$good->id;?></li>
        <li class="market_price"><span>定价：</span><em><?=$good->market_price?></em></li>
        <li class="shop_price"><span>本店价：</span> <strong><?=$good->shop_price?></strong> <a href="">(降价通知)</a></li>
        <li><span>上架时间：</span><?=date('Y-m-d H:i:s',$good->market_price)?></li>
        <li class="star"><span>商品评分：</span> <strong></strong><a href="">(已有21人评价)</a></li> <!-- 此处的星级切换css即可 默认为5星 star4 表示4星 star3 表示3星 star2表示2星 star1表示1星 -->
    </ul>
    <form action="<?=\yii\helpers\Url::to(['shop/notice'])?>" method="post" class="choose">
        <ul>
            <li>
                <dl>
                    <dt>购买数量：</dt>
                    <dd>
                        <a href="javascript:;" id="reduce_num"></a>
                        <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->csrfToken;?>">
                        <input type="hidden" name="goods_id" value="<?=$good->id?>">
                        <input type="text" name="amount" value="1" class="amount"/>
                        <a href="javascript:;" id="add_num"></a>
                    </dd>
                </dl>
            </li>

            <li>
                <dl>
                    <dt>&nbsp;</dt>
                    <dd>
                        <input type="submit" value="" class="add_btn" />
                    </dd>
                </dl>
            </li>

        </ul>
    </form>
</div>