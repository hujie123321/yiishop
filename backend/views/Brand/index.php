<a href="<?php echo \yii\helpers\Url::to(['brand/add'])?>" class="btn bg-danger">添加品牌</a>
<a href="<?php echo \yii\helpers\Url::to(['user/permission-edit'])?>" class="btn bg-danger">回收站</a>
<table class="table">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>logo</th>
        <th>排序</th>
        <th>状态</th>
        <th>简介</th>
        <th>操作</th>
    </tr>

    <?php foreach($brands as $brand):?>
        <tr>
            <td><?= $brand->id?></td>
            <td><?= $brand->name?></td>
            <td><img style="height: 40px;width: 50px" src="<?='/'. $brand->logo?>"></td>
            <td><?= $brand->sort?></td>
            <td><?= \backend\models\Brand::$img[$brand->status]?></td>
            <td><?= $brand->intro?></td>
            <td><a class="btn btn-danger" href="<?php echo \yii\helpers\Url::to(['book/del','id'=> $brand->id])?>">加入回收站</a>
                <a class="btn btn-success" href="<?php echo \yii\helpers\Url::to(['book/edit','id'=> $brand->id])?>">修改</a></td>
        </tr>
    <?php endforeach;?>

</table>
<div style="margin-left: 40%">
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$page,
]);
//?>
</div>

