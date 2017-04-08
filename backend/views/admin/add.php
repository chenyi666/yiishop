<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password')->passwordInput();
echo $form->field($model,'repassword')->passwordInput();
echo $form->field($model,'roles')->checkboxList(\backend\models\Admin::getRoles());
echo $form->field($model,'email');
echo \yii\bootstrap\Html::submitButton('添加',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
