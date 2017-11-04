<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4/004
 * Time: 14:04
 */

namespace backend\models;


use yii\db\ActiveRecord;

class ArticleCategory extends ActiveRecord
{
    public static $arr=['1'=>'显示','2'=>'隐藏'];
    //设置规则
    public function rules()
    {
        return [
            [['name','intro','status','sort'],'required'],
            [['sort'],'integer'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name'=>'分类名称',
            'status'=>'状态',
            'sort'=>'排序',
            'intro'=>'信息'
        ];

    }
}