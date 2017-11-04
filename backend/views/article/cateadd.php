<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($article,'name');
echo $form->field($article,'sort');
$status=[
    '1'=>'显示',
    '2'=>'隐藏'
];
echo $form->field($article,'status')->dropDownList($status);
echo $form->field($article,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();