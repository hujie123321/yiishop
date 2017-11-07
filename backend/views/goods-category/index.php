<h1>文章分类列表</h1>
<?=\yii\bootstrap\Html::a("添加",['add'],['class'=>'btn btn-info'])?>
<?php
use leandrogehlen\treegrid\TreeGrid;
?>

<?= TreeGrid::widget([
    'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'parentRootValue' => '0', //first parentId value
    'pluginOptions' => [
        'initialState' => 'collapsed',
    ],
    'columns' => [
        'name',
        'id',
        'parent_id',
        ['class' => 'yii\grid\ActionColumn']
    ]
]);

