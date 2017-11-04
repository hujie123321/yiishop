<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3/003
 * Time: 19:01
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Brand extends ActiveRecord
{
    public static $img=['1'=>'显示','2'=>'隐藏'];


    public function rules()
    {
        return [
            [['name','intro','status','sort','logo'],'required'],
            [['sort'],'integer'],
        ];

        //
    }

    public function attributeLabels()
    {
        return [
            'name'=>'品牌名字',
            'status'=>'状态',
            'sort'=>'排序',
            'intro'=>'品牌简介',
           // 'imgFile'=>'logo'
            // 'cate_id'=>'分类'
        ];
    }

}