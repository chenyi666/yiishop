<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'status')->inline()->radioList(\backend\models\ArticleCategory::$status_zt);
echo $form->field($model,'is_help')->inline()->radioList(\backend\models\ArticleCategory::$is_help_zt);
echo $form->field($model,'sort');
echo \yii\bootstrap\Html::submitButton('添加',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
