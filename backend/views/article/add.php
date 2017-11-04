<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($article,'name');
$arr=\backend\models\ArticleCategory::find()->all();
$option=[];
foreach($arr as $k=>$v){
    $option[$v['id']]=$v['name'];
}
echo $form->field($article,'article_category_id')->dropDownList($option);
$status=[
    '1'=>'显示',
    '2'=>'隐藏'
];
echo $form->field($article,'status')->dropDownList($status);
echo $form->field($article,'sort');
echo $form->field($article,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn bg-success']);
\yii\bootstrap\ActiveForm::end();
