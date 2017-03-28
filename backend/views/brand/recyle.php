<table class="table">
    <tr>
        <th>ID</th>
        <th>品牌名</th>
        <th>logo</th>
        <th>状态</th>
        <th>排序</th>
        <th>操作</th>
    </tr>
    <?php foreach ($brands as $brand):?>
        <tr>
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=\yii\bootstrap\Html::img('@web'.$brand->logo,['height'=>'30px'])?></td>
            <td><?=\backend\models\Brand::$status_zt[$brand->status]?></td>
            <td><?=$brand->sort?></td>
            <td><?=\yii\bootstrap\Html::a('编辑',['brand/edit','id'=>$brand->id],['class'=>'btn btn-success'])?> <?=\yii\bootstrap\Html::a('删除',['brand/del','id'=>$brand->id],['class'=>'btn btn-danger'])?></td>

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