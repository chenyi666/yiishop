<?php
use yii\helpers\Html;
use frontend\assets\ShopAsset;
ShopAsset::register($this);?>
<?php $cates=\frontend\models\shop::getCate();
$articles_cates=\frontend\models\shop::getArticle();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <li>您好，欢迎来到京西！[<a href="login.html">登录</a>] [<a href="register.html">免费注册</a>] </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 头部 start -->
<div class="header w1210 bc mt15">
    <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
    <div class="logo w1210">
        <h1 class="fl"><a href="index.html"><img src="<?=Yii::getAlias('@web')?>/images/logo.png" alt="京西商城"></a></h1>
        <!-- 头部搜索 start -->
        <div class="search fl">
            <div class="search_form">
                <div class="form_left fl"></div>
                <form action="" name="serarch" method="get" class="fl">
                    <input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
                </form>
                <div class="form_right fl"></div>
            </div>

            <div style="clear:both;"></div>

            <div class="hot_search">
                <strong>热门搜索:</strong>
                <a href="">D-Link无线路由</a>
                <a href="">休闲男鞋</a>
                <a href="">TCL空调</a>
                <a href="">耐克篮球鞋</a>
            </div>
        </div>
        <!-- 头部搜索 end -->

        <!-- 用户中心 start-->
        <div class="user fl">
            <dl>
                <dt>
                    <em></em>
                    <a href="">用户中心</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        您好，请<a href="">登录</a>
                    </div>
                    <div class="uclist mt10">
                        <ul class="list1 fl">
                            <li><a href="">用户信息></a></li>
                            <li><a href="">我的订单></a></li>
                            <li><a href="">收货地址></a></li>
                            <li><a href="">我的收藏></a></li>
                        </ul>

                        <ul class="fl">
                            <li><a href="">我的留言></a></li>
                            <li><a href="">我的红包></a></li>
                            <li><a href="">我的评论></a></li>
                            <li><a href="">资金管理></a></li>
                        </ul>

                    </div>
                    <div style="clear:both;"></div>
                    <div class="viewlist mt10">
                        <h3>最近浏览的商品：</h3>
                        <ul>
                            <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/view_list1.jpg" alt="" /></a></li>
                            <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/view_list2.jpg" alt="" /></a></li>
                            <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/view_list3.jpg" alt="" /></a></li>
                        </ul>
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 用户中心 end-->

        <!-- 购物车 start -->
        <div class="cart fl">
            <dl>
                <dt>
                    <a href="">去购物车结算</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        购物车中还没有商品，赶紧选购吧！
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 购物车 end -->
    </div>
    <!-- 头部上半部分 end -->

    <div style="clear:both;"></div>

    <!-- 导航条部分 start -->
    <div class="nav w1210 bc mt10">
        <!--  商品分类部分 start-->
        <div class="category fl"> <!-- 非首页，需要添加cat1类 -->
            <div class="cat_hd">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>

            <div class="cat_bd">
                <?php foreach ($cates as $cate):?>
                    <div class="cat"><h3><a href=""><?=$cate->name?></a> <b></b></h3>
                        <div class="cat_detail">
                            <?php foreach($cate->child as $child): ?>
                                <dl class="dl_1st">
                                    <dt><a href=""><?=$child->name?></a></dt>
                                    <?php foreach ($child->child as $son):?>
                                        <dd>
                                            <a href=""><?=$son->name?></a>
                                        </dd>
                                    <?php endforeach;?>
                                </dl>
                            <?php endforeach;?>
                        </div>
                    </div>

                <?php endforeach;?>
            </div>
        </div>



        <!--  商品分类部分 end-->

        <div class="navitems fl">
            <ul class="fl">
                <li class="current"><a href="">首页</a></li>
                <li><a href="">电脑频道</a></li>
                <li><a href="">家用电器</a></li>
                <li><a href="">品牌大全</a></li>
                <li><a href="">团购</a></li>
                <li><a href="">积分商城</a></li>
                <li><a href="">夺宝奇兵</a></li>
            </ul>
            <div class="right_corner fl"></div>
        </div>
    </div>
    <!-- 导航条部分 end -->
</div>
<!-- 头部 end-->

<div style="clear:both;"></div>

<!-- 综合区域 start 包括幻灯展示，商城快报 -->
<div class="colligate w1210 bc mt10">
    <!-- 幻灯区域 start -->
    <div class="slide fl">
        <div class="area">
            <?php Yii::getAlias('@web')?>
            <div class="slide_items">
                <ul>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/index_slide1.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/index_slide2.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/index_slide3.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/index_slide4.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/index_slide5.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/index_slide6.jpg" alt="" /></a></li>
                </ul>
            </div>
            <div class="slide_controls">
                <ul>
                    <li class="on">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 幻灯区域 end-->

    <!-- 快报区域 start-->
    <div class="coll_right fl ml10">
        <div class="ad"><a href=""><img src="<?=Yii::getAlias('@web')?>/images/ad.jpg" alt="" /></a></div>

        <div class="news mt10">
            <h2><a href="">更多快报&nbsp;></a><strong>网站快报</strong></h2>
            <ul>
                <li class="odd"><a href="">电脑数码双11爆品抢不停</a></li>
                <li><a href="">买茶叶送武夷山旅游大奖</a></li>
                <li class="odd"><a href="">爆款手机最高直降1000</a></li>
                <li><a href="">新鲜褚橙全面包邮开售！</a></li>
                <li class="odd"><a href="">家具家装全场低至3折</a></li>
                <li><a href="">买韩束，志玲邀您看电影</a></li>
                <li class="odd"><a href="">美的先行惠双11快抢悦</a></li>
                <li><a href="">享生活 疯狂周期购！</a></li>
            </ul>

        </div>

        <div class="service mt10">
            <h2>
                <span class="title1 on"><a href="">话费</a></span>
                <span><a href="">旅行</a></span>
                <span><a href="">彩票</a></span>
                <span class="title4"><a href="">游戏</a></span>
            </h2>
            <div class="service_wrap">
                <!-- 话费 start -->
                <div class="fare">
                    <form action="">
                        <ul>
                            <li>
                                <label for="">手机号：</label>
                                <input type="text" name="phone" value="请输入手机号" class="phone" />
                                <p class="msg">支持移动、联通、电信</p>
                            </li>
                            <li>
                                <label for="">面值：</label>
                                <select name="" id="">
                                    <option value="">10元</option>
                                    <option value="">20元</option>
                                    <option value="">30元</option>
                                    <option value="">50元</option>
                                    <option value="" selected>100元</option>
                                    <option value="">200元</option>
                                    <option value="">300元</option>
                                    <option value="">400元</option>
                                    <option value="">500元</option>
                                </select>
                                <strong>98.60-99.60</strong>
                            </li>
                            <li>
                                <label for="">&nbsp;</label>
                                <input type="submit" value="点击充值" class="fare_btn" /> <span><a href="">北京青春怒放独家套票</a></span>
                            </li>
                        </ul>
                    </form>
                </div>
                <!-- 话费 start -->

                <!-- 旅行 start -->
                <div class="travel none">
                    <ul>
                        <li>
                            <a href=""><img src="<?=Yii::getAlias('@web')?>/images/holiday.jpg" alt="" /></a>
                            <a href="" class="button">度假查询</a>
                        </li>
                        <li>
                            <a href=""><img src="<?=Yii::getAlias('@web')?>/images/scenic.jpg" alt="" /></a>
                            <a href="" class="button">景点查询</a>
                        </li>
                    </ul>
                </div>
                <!-- 旅行 end -->

                <!-- 彩票 start -->
                <div class="lottery none">
                    <p><img src="<?=Yii::getAlias('@web')?>/images/lottery.jpg" alt="" /></p>
                </div>
                <!-- 彩票 end -->

                <!-- 游戏 start -->
                <div class="game none">
                    <ul>
                        <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/sanguo.jpg" alt="" /></a></li>
                        <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/taohua.jpg" alt="" /></a></li>
                        <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/wulin.jpg" alt="" /></a></li>
                    </ul>
                </div>
                <!-- 游戏 end -->
            </div>
        </div>

    </div>
    <!-- 快报区域 end-->
</div>
<!-- -综合区域 end -->

<div style="clear:both;"></div>

<!-- 导购区域 start -->
<div class="guide w1210 bc mt15">
    <!-- 导购左边区域 start -->
    <div class="guide_content fl">
        <h2>
            <span class="on">新品上架</span>
            <span>热卖商品</span>
            <span>精品推荐</span>
        </h2>

        <div class="guide_wrap">
            <!-- 疯狂抢购 start-->
            <div class="crazy">
                <ul>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/crazy1.jpg" alt="" /></a></dt>
                            <dd><a href="">惠普G4-1332TX 14英寸</a></dd>
                            <dd><span>售价：</span><strong> ￥2999.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/crazy2.jpg" alt="" /></a></dt>
                            <dd><a href="">直降100元！TCL118升冰箱</a></dd>
                            <dd><span>售价：</span><strong> ￥800.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/crazy3.jpg" alt="" /></a></dt>
                            <dd><a href="">康佳液晶37寸电视机</a></dd>
                            <dd><span>售价：</span><strong> ￥2799.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/crazy4.jpg" alt="" /></a></dt>
                            <dd><a href="">梨子平板电脑7.9寸</a></dd>
                            <dd><span>售价：</span><strong> ￥1999.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/crazy5.jpg" alt="" /></a></dt>
                            <dd><a href="">好声音耳机</a></dd>
                            <dd><span>售价：</span><strong> ￥199.00</strong></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!-- 疯狂抢购 end-->

            <!-- 热卖商品 start -->
            <div class="hot none">
                <ul>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/hot1.jpg" alt="" /></a></dt>
                            <dd><a href="">索尼双核五英寸四核手机！</a></dd>
                            <dd><span>售价：</span><strong> ￥1386.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/hot2.jpg" alt="" /></a></dt>
                            <dd><a href="">华为通话平板仅需969元！</a></dd>
                            <dd><span>售价：</span><strong> ￥969.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/hot3.jpg" alt="" /></a></dt>
                            <dd><a href="">卡姿兰明星单品7件彩妆套装</a></dd>
                            <dd><span>售价：</span><strong> ￥169.00</strong></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!-- 热卖商品 end -->

            <!-- 推荐商品 atart -->
            <div class="recommend none">
                <ul>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/recommend1.jpg" alt="" /></a></dt>
                            <dd><a href="">黄飞红麻辣花生整箱特惠装</a></dd>
                            <dd><span>售价：</span><strong> ￥139.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/recommend2.jpg" alt="" /></a></dt>
                            <dd><a href="">戴尔IN1940MW 19英寸LE</a></dd>
                            <dd><span>售价：</span><strong> ￥679.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/recommend3.jpg" alt="" /></a></dt>
                            <dd><a href="">罗辑思维音频车载CD</a></dd>
                            <dd><span>售价：</span><strong> ￥24.80</strong></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!-- 推荐商品 end -->

        </div>

    </div>
    <!-- 导购左边区域 end -->

    <!-- 侧栏 网站首发 start-->
    <div class="sidebar fl ml10">
        <h2><strong>网站首发</strong></h2>
        <div class="sidebar_wrap">
            <dl class="first">
                <dt class="fl"><a href=""><img src="<?=Yii::getAlias('@web')?>/images/viewsonic.jpg" alt="" /></a></dt>
                <dd><strong><a href="">ViewSonic优派N710 </a></strong> <em>首发</em></dd>
                <dd>苹果iphone 5免费送！攀高作为全球智能语音血压计领导品牌，新推出的黑金刚高端智能电子血压计，改变传统测量方式让血压测量迈入一体化时代。</dd>
            </dl>

            <dl>
                <dt class="fr"><a href=""><img src="<?=Yii::getAlias('@web')?>/images/samsung.jpg" alt="" /></a></dt>
                <dd><strong><a href="">Samsung三星Galaxy</a></strong> <em>首发</em></dd>
                <dd>电视百科全书，360°无死角操控，感受智能新体验！双核CPU+双核GPU+MEMC运动防抖，58寸大屏打造全新视听盛宴！</dd>
            </dl>
        </div>


    </div>
    <!-- 侧栏 网站首发 end -->

</div>
<!-- 导购区域 end -->

<div style="clear:both;"></div>

<!--1F 电脑办公 start -->
<div class="floor1 floor w1210 bc mt10">
    <!-- 1F 左侧 start -->
    <div class="floor_left fl">
        <!-- 商品分类信息 start-->
        <div class="cate fl">
            <h2>电脑、办公</h2>
            <div class="cate_wrap">
                <ul>
                    <li><a href=""><b>.</b>外设产品</a></li>
                    <li><a href=""><b>.</b>鼠标</a></li>
                    <li><a href=""><b>.</b>笔记本</a></li>
                    <li><a href=""><b>.</b>超极本</a></li>
                    <li><a href=""><b>.</b>平板电脑</a></li>
                    <li><a href=""><b>.</b>主板</a></li>
                    <li><a href=""><b>.</b>显卡</a></li>
                    <li><a href=""><b>.</b>打印机</a></li>
                    <li><a href=""><b>.</b>一体机</a></li>
                    <li><a href=""><b>.</b>投影机</a></li>
                    <li><a href=""><b>.</b>路由器</a></li>
                    <li><a href=""><b>.</b>网卡</a></li>
                    <li><a href=""><b>.</b>交换机</a></li>
                </ul>
                <p><a href=""><img src="<?=Yii::getAlias('@web')?>/images/notebook.jpg" alt="" /></a></p>
            </div>


        </div>
        <!-- 商品分类信息 end-->

        <!-- 商品列表信息 start-->
        <div class="goodslist fl">
            <h2>
                <span class="on">推荐商品</span>
                <span>精品</span>
                <span>热卖</span>
            </h2>

          <?=$content?>

                <div class="none">
                    <ul>
                        <li>
                            <dl>
                                <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/hpG4.jpg" alt="" /></a></dt>
                                <dd><a href="">惠普G4-1332TX 14英寸笔</a></dd>
                                <dd><span>售价：</span> <strong>￥2999.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/qinghuax2.jpg" alt="" /></a></dt>
                                <dd><a href="">清华同方精锐X2笔记本 </a></dd>
                                <dd><span>售价：</span> <strong>￥2499.00</strong></dd>
                            </dl>
                        </li>

                    </ul>
                </div>

                <div class="none">
                    <ul>
                        <li>
                            <dl>
                                <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/thinkpad e420.jpg" alt="" /></a></dt>
                                <dd><a href="">ThinkPad E42014英寸笔..</a></dd>
                                <dd><span>售价：</span> <strong>￥4199.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href=""><img src="<?=Yii::getAlias('@web')?>/images/acer4739.jpg" alt="" /></a></dt>
                                <dd><a href="">宏碁AS4739-382G32Mnk</a></dd>
                                <dd><span>售价：</span> <strong>￥2799.00</strong></dd>
                            </dl>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- 商品列表信息 end-->
    </div>
    <!-- 1F 左侧 end -->

    <!-- 右侧 start -->
    <div class="sidebar fl ml10">
        <!-- 品牌旗舰店 start -->
        <div class="brand">
            <h2><a href="">更多品牌&nbsp;></a><strong>品牌旗舰店</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/dell.gif" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/acer.gif" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/fujitsu.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/hp.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/lenove.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/samsung.gif" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/dlink.gif" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/seagate.jpg" alt="" /></a></li>
                    <li><a href=""><img src="<?=Yii::getAlias('@web')?>/images/intel.jpg" alt="" /></a></li>
                </ul>
            </div>
        </div>
        <!-- 品牌旗舰店 end -->

        <!-- 分类资讯 start -->
        <div class="info mt10">
            <h2><strong>分类资讯</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <li><a href=""><b>.</b>iphone 5s土豪金大量到货</a></li>
                    <li><a href=""><b>.</b>三星note 3低价促销</a></li>
                    <li><a href=""><b>.</b>thinkpad x240即将上市</a></li>
                    <li><a href=""><b>.</b>双十一来临，众商家血拼</a></li>
                </ul>
            </div>

        </div>
        <!-- 分类资讯 end -->

        <!-- 广告 start -->
        <div class="ads mt10">
            <a href=""><img src="<?=Yii::getAlias('@web')?>/images/canon.jpg" alt="" /></a>
        </div>
        <!-- 广告 end -->
    </div>
    <!-- 右侧 end -->

</div>
<!--1F 电脑办公 start -->


<div style="clear:both;"></div>

<!-- 底部导航 start -->
<div class="bottomnav w1210 bc mt10">
    <?php $i=1?>
        <?php foreach ($articles_cates as $article_cate):?>
            <div class="bnav<?=$i++?>">
            <h3><b></b><em><?=$article_cate->name?></em></h3>
            <ul>
              <?php foreach($article_cate->article as $child):?>
               <li><a href=""><?=$child->name?></a></li>
                <?php endforeach;?>
           </ul>
    </div>
        <?php endforeach;?>
<!--    <div class="bnav2">
        <h3><b></b> <em>购物指南</em></h3>
        <ul>
            <li><a href="">购物流程</a></li>
            <li><a href="">会员介绍</a></li>
            <li><a href="">团购/机票/充值/点卡</a></li>
            <li><a href="">常见问题</a></li>
            <li><a href="">大家电</a></li>
            <li><a href="">联系客服</a></li>
        </ul>
    </div>-->
</div>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt10">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="<?=Yii::getAlias('@web')?>/images/xin.png" alt="" /></a>
        <a href=""><img src="<?=Yii::getAlias('@web')?>/images/kexin.jpg" alt="" /></a>
        <a href=""><img src="<?=Yii::getAlias('@web')?>/images/police.jpg" alt="" /></a>
        <a href=""><img src="<?=Yii::getAlias('@web')?>/images/beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>