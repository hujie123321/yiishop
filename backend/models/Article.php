<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4/004
 * Time: 14:00
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    public function rules()
    {
        return [
            [['name','article_category_id','intro','status','sort'],'required'],
            [['sort'],'integer'],
            [['createtime'],'safe'],
        ];

        //
    }
    public function attributeLabels()
    {
        return [
            'name'=>'文章名称',
            'article_category_id'=>'分类',
            'status'=>'状态',
            'sort'=>'排序',
            'intro'=>'信息',
            'createtime'=>'添加时间',
        ];

    }

    public function getCate()
    {
        return ArticleCategory::findOne($this->article_category_id)->name;
    }
}