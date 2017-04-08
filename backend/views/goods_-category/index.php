<?php
echo \yii\bootstrap\Html::a('添加',['goods_-category/add'],['class'=>'btn btn-info']);?>
<table class="table">
    <tr>
        <th>ID</th>
        <th>名字</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
    <tbody>
    <?php foreach ($goodscates as $goodscate):?>

        <tr data-lft="<?=$goodscate->lft?>" data-rght="<?=$goodscate->rght?>" data-tree="<?=$goodscate->tree?>">
            <td><?=$goodscate->id?></td>
            <td><?=$goodscate->name?></td>
            <td><?=str_repeat('<span class="glyphicon glyphicon-minus"></span>',$goodscate->depth).$goodscate->intro?><span class="glyphicon glyphicon-chevron-up expand" style="float: right"></span></td>
            <td><?=\yii\bootstrap\Html::a('编辑',['goods_-category/edit','id'=>$goodscate->id],['class'=>'btn btn-success'])?> <?=\yii\bootstrap\Html::a('删除',['goods_-category/del','id'=>$goodscate->id],['class'=>'btn btn-danger'])?></td>

        </tr>
    </tbody>
    <?php endforeach;?>
</table>
<?php
$js=<<<EOT
    $(".expand").click(function(){
        $(this).toggleClass("glyphicon-chevron-up");
        $(this).toggleClass("glyphicon-chevron-down");

        var tr = $(this).closest("tr");
        var p_lft = tr.attr("data-lft");
        var p_rght = tr.attr("data-rght");
        var p_tree= tr.attr("data-tree");
        $("tbody tr").each(function(){
            var lft = $(this).attr("data-lft");
            var rght = $(this).attr("data-rght");
            var tree = $(this).attr("data-tree");
            if(tree == p_tree &&　lft>p_lft && rght<p_rght){
                $(this).fadeToggle();
            }
        });
    });
EOT;

$this->registerJs($js);