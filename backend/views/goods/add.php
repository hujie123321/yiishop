<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($goods,'name');
echo $form->field($goods, 'logo')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => false,
        ],
        'server' => \yii\helpers\Url::to(['upload']),
        'accept' => [
            'extensions' => 'png,jpg',
        ],
    ],
]);
echo $form->field($goods, 'path')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
         'server' => \yii\helpers\Url::to(['upload']),
         'accept' => [
         	'extensions' => 'png,jpg',
         ],
    ],
]);
echo $form->field($goods,'goods_category_id')->dropDownList($goodsCategory);
echo $form->field($goods,'brand_id')->dropDownList($brand);
echo $form->field($goods,'market_price');
echo $form->field($goods,'shop_price');
echo $form->field($goods,'stock');
echo $form->field($goods,'in_on_sale')->inline()->radioList(['0'=>'是','1'=>'否']);
echo $form->field($goods,'sort');
echo $form->field($goods,'content')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn bg-success']);
\yii\bootstrap\ActiveForm::end();
