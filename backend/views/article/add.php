<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'status')->inline()->radioList(\backend\models\Article::$status_zt);
echo $form->field($model,'article_category_id')->dropDownList($cates_option);
echo $form->field($model,'sort');
echo  $form->field($model,'content')->textarea();
echo \yii\bootstrap\Html::submitButton('添加',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
