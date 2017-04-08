<?php
/* @var $this yii\web\View */
?>
<h1>rbac/index</h1>
<table class="table">
    <tr>
        <th>权限名</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($permissons as $permisson):?>
    <tr>
        <td><?=$permisson->name?></td>
        <td><?=$permisson->description?></td>
        <td><?=\yii\bootstrap\Html::a('删除',['rbac/delPermisson','name'=>$permisson->name])?></td>
    </tr>
    <?php endforeach;?>
</table>
