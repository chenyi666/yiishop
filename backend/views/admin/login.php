<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password')->passwordInput();
/*echo $form->field($model,'code')->widget(\yii\captcha\Captcha::className(),['template'=>'<div class="row"><div class="clo-lg-3">{image}</div><div class="clo-lg-6">{input}</div></div>']);*/
echo $form->field($model,'rememberMe')->checkbox();
echo \yii\bootstrap\Html::submitButton('登录',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();