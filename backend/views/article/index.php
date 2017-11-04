<table class="table">
    <tr>
        <th>id</th>
        <th>名字</th>
        <th>父级分类</th>
        <th>状态</th>
        <th>排序</th>
        <th>添加时间</th>
        <th>简介</th>
        <th>操作</th>
    </tr>

    <?php foreach($rows as $row):?>
        <tr>
            <td><?= $row->id?></td>
            <td><?= $row->name?></td>
            <td><?= $row->cate?></td>
            <td><?= \backend\models\ArticleCategory::$arr[$row->status]?></td>
            <td><?= $row->sort?></td>
            <td><?= date('Y-m-d H:i:s',$row->createtime)?></td>
            <td><?= $row->intro?></td>
            <td><a class="btn btn-danger" href="<?php echo \yii\helpers\Url::to(['article/del','id'=> $row->id])?>">删除</a>
                <a class="btn btn-success" href="<?php echo \yii\helpers\Url::to(['article/edit','id'=> $row->id])?>">修改</a></td>
        </tr>
    <?php endforeach;?>

</table>
<?php
//echo \yii\widgets\LinkPager::widget([
//    'pagination'=>$page
//]);
//?>