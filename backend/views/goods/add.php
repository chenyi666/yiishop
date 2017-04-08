<?php
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
/*echo $form->field($model,'intro')->textarea();*/
echo $form->field($model,'logo_file')->fileInput();
/*echo $form->field($model,'logo')->hiddenInput();*/
/*//Remove Events Auto Convert
//外部TAG
echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
echo \xj\uploadify\Uploadify::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'width' => 120,
        'height' => 40,
        'onUploadError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
        ),
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        $('#brand-logo').val(data.fileUrl)
        $('#img').attr('src',data.fileUrl)
    }
}
EOF
        ),
    ]
]);*/
/*echo \yii\bootstrap\Html::img($model->logo,['id'=>'img','height'=>'50px']);*/
echo $form->field($model,'status')->inline()->radioList(\backend\models\Goods::$status_zt);
echo $form->field($model,'is_on_sale')->inline()->radioList(\backend\models\Goods::$is_on_sale);
echo $form->field($model,'sort');
echo $form->field($model,'shop_price');
echo $form->field($model,'market_price');/*
echo $form->field($model,'goods_category_id')->dropDownList($cate_option);*/
echo $form->field($model,'goods_category_id')->hiddenInput();
echo $form->field($model,'depth')->hiddenInput();
echo '<div>
    <ul id="treeDemo" class="ztree"></ul>
</div>';
echo $form->field($model,'brand_id')->dropDownList($brand_option);
/*echo $form->field($content,'content')->textarea();*/
echo $form->field($content,'content')->widget('kucha\ueditor\UEditor',[]);
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
                $("#goods-goods_category_id").val(treeNode.id);
                $("#goods-depth").val(treeNode.depth)
		    }
	    }
	};
        // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
        var zNodes ={$cate}
            zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            zTreeObj.expandAll(true)
            // treeObj.getNodeByParam("id", 1, null);
            zTreeObj.selectNode(zTreeObj.getNodeByParam("id",'{$model->goods_category_id}',null))
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
