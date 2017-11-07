<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7/007
 * Time: 11:44
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Goods extends ActiveRecord
{
    public $path;
    public $content;
    public function rules()
    {
        return [
            [['name','logo','goods_category_id','brand_id','market_price','shop_price','stock','in_on_sale','sort','path','content'],'required'],
            [['sn','create_time'],'safe'],
            [['sort','market_price','shop_price','stock','sort'],'integer'],
        ];

        //
    }

    public function attributeLabels()
    {
        return [
            'name'=>'商品名字',
            'logo'=>'商品封面',
            'goods_category_id'=>'商品分类',
            'brand_id'=>'品牌',
            'market_price'=>'市场价格',
            'shop_price'=>'本店价格',
            'stock'=>'库存',
            'in_on_sale'=>'是否上架',
            'sort'=>'排序',
            'content'=>'商品简介',
            'path'=>'商品详细图片'
        ];
    }
}