<?php
echo \yii\bootstrap\Html::a('添加',['article/add'],['class'=>'btn btn-info']);
?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>名字</th>
            <th>分类</th>
            <th>是否显示</th>
            <th>排序</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        <?php foreach ($articles as $article):?>
            <tr>
                <td><?=$article->id?></td>
                <td><?=$article->name?></td>
                <td><?=$article->cate->name?></td>
                <td><?=\backend\models\Article::$status_zt[$article->status]?></td>
                <td><?=$article->sort?></td>
                <td><?=date('Y-m-d H:i:s',$article->inputtime)?></td>
                <td><?=\yii\bootstrap\Html::a('编辑',['article/edit','id'=>$article->id],['class'=>'btn btn-success'])?> <?=\yii\bootstrap\Html::a('删除',['article/del','id'=>$article->id],['class'=>'btn btn-danger'])?></td>

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