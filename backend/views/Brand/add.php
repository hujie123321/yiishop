<?php
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($brand,'name');
echo $form->field($brand,'sort');
$arr=[
    '1'=>'显示',
    '2'=>'隐藏'
];
echo $form->field($brand,'status')->dropDownList($arr);
echo $form->field($brand, 'logo')->widget('manks\FileInput', []);
echo $form->field($brand,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn bg-success']);
\yii\bootstrap\ActiveForm::end();

