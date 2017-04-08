<?php
/* @var $this yii\web\View */

echo \yii\bootstrap\Html::a('添加',['goods/add'],['class'=>'btn btn-info']);
echo \yii\bootstrap\Html::a('回收站',['goods/recycle'],['class'=>'btn btn-danger'])

?>
<h1>goods/index</h1>

<div class="container form-group">
    <?php $form=\yii\bootstrap\ActiveForm::begin(['method'=>'get','options'=>['class'=>'form-inline well'],'action'=>\yii\helpers\Url::to(['goods/index'])]);
    echo $form->field($search,'name');
    echo $form->field($search,'sn');
    echo $form->field($search,'min_price');
    echo $form->field($search,'max_price');
    echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
    echo \yii\bootstrap\Html::submitButton('搜索',['class'=>'btn btn-info']);
    \yii\bootstrap\ActiveForm::end();
    ?>
</div>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>品牌名</th>
            <th>logo</th>
            <th>状态</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        <?php foreach ($goods as $good):?>
            <tr>
                <td><?=$good->id?></td>
                <td><?=$good->name?></td>
               <!-- <td><?/*=\yii\bootstrap\Html::img($good->logoUrl(),['height'=>'30px'])*/?></td>-->
                <td><?=\yii\bootstrap\Html::img('@web/'.$good->logo,['height'=>'30px'])?></td>
                <td><?=\backend\models\ Goods::$status_zt[$good->status]?></td>
                <td><?=$good->sort?></td>
                <td><?=\yii\bootstrap\Html::a('编辑',['goods/edit','id'=>$good->id],['class'=>'btn btn-success'])?> <?=\yii\bootstrap\Html::a('删除',['goods/del','id'=>$good->id],['class'=>'btn btn-danger'])?></td>

            </tr>
        <?php endforeach;?>
    </table>
<?php
/*
 * 分页工具条  LinkPager
 */
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$pager,
    'nextPageLabel'=>'下一页',
    'prevPageLabel'=>'上一页',
]);