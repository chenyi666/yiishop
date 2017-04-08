<?php
echo \yii\bootstrap\Html::a('添加',['admin/add'],['class'=>'btn btn-info']);
?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>最后登录时间</th>
            <th>最后登录IP</th>
            <th>注册时间</th>
            <th>操作</th>
        </tr>
        <?php foreach ($admins as $admin):?>
            <tr>
                <td><?=$admin->id?></td>
                <td><?=$admin->username?></td>
                <td><?=$admin->email?></td>
                <td><?=date('Y-m-d H:i:s',$admin->last_login_time)?></td>
                <td><?=$admin->last_login_ip?></td>
                <td><?=date('Y-m-d H:i:s',$admin->addtime)?></td>
                <td><?=\yii\bootstrap\Html::a('编辑',['admin/edit','id'=>$admin->id],['class'=>'btn btn-success'])?> <?=\yii\bootstrap\Html::a('删除',['admin/del','id'=>$admin->id],['class'=>'btn btn-danger'])?></td>

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