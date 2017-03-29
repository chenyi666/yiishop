<?php
echo \yii\bootstrap\Html::a('添加',['article_-category/add'],['class'=>'btn btn-info']);
?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>名字</th>
            <th>状态</th>
            <th>排序</th>
            <th>是否是帮助类文章</th>
            <th>操作</th>
        </tr>
        <?php foreach ($article_cates as $article_cate):?>
            <tr>
                <td><?=$article_cate->id?></td>
                <td><?=$article_cate->name?></td>
                <td><?=\backend\models\ArticleCategory::$status_zt[$article_cate->status]?></td>
                <td><?=$article_cate->sort?></td>
                <td><?=\backend\models\ArticleCategory::$is_help_zt[$article_cate->is_help]?></td>
                <td><?=\yii\bootstrap\Html::a('编辑',['article_-category/edit','id'=>$article_cate->id],['class'=>'btn btn-success'])?> <?=\yii\bootstrap\Html::a('删除',['article_-category/del','id'=>$article_cate->id],['class'=>'btn btn-danger'])?></td>

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