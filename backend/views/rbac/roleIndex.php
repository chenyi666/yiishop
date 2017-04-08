<table class="table">
    <tr>
        <th>角色名</th>
        <th>描述</th>
        <th>拥有的权限</th>
        <th>操作</th>
    </tr>
    <?php foreach ($roles as $role):?>
        <tr>
            <td><?=$role->name?></td>
            <td><?=$role->description?></td>
            <td><?=$role->name?></td>
            <td><?=\yii\bootstrap\Html::a('删除',['rbac/del-role','name'=>$role->name])?>
                <?=\yii\bootstrap\Html::a('编辑',['rbac/edit-role','name'=>$role->name])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>