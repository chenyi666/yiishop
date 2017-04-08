<?php
/**
 * @var $this \yii\web\View
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'parent_id')->hiddenInput();
echo '<div>
    <ul id="treeDemo" class="ztree"></ul>
</div>';
echo \yii\bootstrap\Html::submitButton('添加',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
//给当前视图注册js文件
//'depends'=>\yii\web\JqueryAsset::className()  当前的js文件需要依赖jquery(在jquery.js文件后面加载)
$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',
    ['depends'=>\yii\web\JqueryAsset::className()]);
$js=<<<etc
       var zTreeObj;
        // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
        var setting = {	data: {
		    simpleData: {
			enable: true,
			idKey: "id",
			pIdKey: "parent_id",
			rootPId: 0
		}	
	},
	callback: {
		    onClick: function(event, treeId, treeNode){
                //console.log(treeNode.id);
                $("#goodscategory-parent_id").val(treeNode.id);
		    }
	    }
	};
        // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
        var zNodes ={$cate}
            zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            zTreeObj.expandAll(true)
            // treeObj.getNodeByParam("id", 1, null);
            zTreeObj.selectNode(zTreeObj.getNodeByParam("id",'{$model->parent_id}',null))
etc;
$this->registerJs($js);
?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <TITLE> ZTREE DEMO </TITLE>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <script type="text/javascript" src="/zTree/js/jquery-1.4.4.min.js"></script>
</HEAD>
<BODY>

</BODY>
</HTML>
