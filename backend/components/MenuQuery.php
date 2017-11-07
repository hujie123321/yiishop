<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/5/005
 * Time: 14:18
 */

namespace backend\components;

use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

class MenuQuery extends ActiveQuery
{

    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),

        ];

    }
}