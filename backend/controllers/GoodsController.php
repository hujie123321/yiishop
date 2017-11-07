<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7/007
 * Time: 11:33
 */

namespace backend\controllers;


use app\models\GoodsCategory;
use app\models\GoodsDayCount;
use app\models\GoodsGallery;
use app\models\GoodsIntro;
use backend\models\Brand;
use backend\models\Goods;
use flyok666\qiniu\Qiniu;
use simpleDIHelpers\AnotherHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;

class GoodsController extends Controller
{
    public function actionIndex()
    {
        $goods=Goods::find()->orderBy(['sort'])->all();
        return $this->render('index',['goods'=>$goods]);
    }

    public function actionAdd()
    {
        $goods=new Goods();
        $goodsCategory=GoodsCategory::find()->all();
        $goodsCategory=ArrayHelper::map($goodsCategory,'id','name');
        $brand=Brand::find()->all();
        $brand=ArrayHelper::map($brand,'id','name');
        $re=new Request();
        if($re->isPost){
            if($goods->load($re->post()) && $goods->validate()){
                /*
                 *1.首先商品货号从商品数量表取出来
                 * 生成货号 数据添加成功  给数量表加1
                 *
                 * */
                //拼一个当天日期
                $time=date('Ymd',time());
                //然后通过当天日期去数量表查询
                $aa=GoodsDayCount::find()->where(['day'=>$time])->one();
                //定义一个货号的变量
                $sn='';
                //如果为空 说明当天没有添加商品  这样货号可以写死  也可以把数量表添加当天的数据
                if(empty($aa)){
                    $sn=$time.'00001';
                    $goodsDayCount=new GoodsDayCount();
                    $goodsDayCount->day=$time;
                    $goodsDayCount->count=1;
                    $goodsDayCount->save();
                }else{
                    $count=$aa->count;
                   $sn=$time.substr('0000'.($count+1),-5);
                   $aa->count=$count+1;
                   $aa->save();
                }
                $goods->sn=$sn;
               // echo $sn;
                $goods->create_time=time();
                     $id=$goods->save();
               //      var_dump($re->post()[]);exit;
                //获取多文件上传的数据
                   $path=$re->post()['Goods']['path'];
                   //循环添加到商品和图片的中间表
                    foreach ($path as $v){
                        $imags=new GoodsGallery();
                        $imags->goods_id=$id;
                        $imags->path=$v;
                        $imags->save();
                    }
                    $intro=new GoodsIntro();
                    $intro->goods_id=$id;
                    $intro->content=$goods->content;
                    $intro->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect('index');
            }
        }
        return $this->render('add',['goods'=>$goods,'goodsCategory'=>$goodsCategory,'brand'=>$brand]);
     }
    public function actionUpload()
    {
        // echo 1;exit;

        $config = [
            'accessKey'=>'YvTs30yPWXWF01FlGlaHuZLJheFhJdpben_OUmkg',
            'secretKey'=>'PfVw8cPvvS4tmC0SvwlvMzXNDOKy8VMaDouPXPap',
            'domain'=>'http://oyvhwk66i.bkt.clouddn.com/',
            'bucket'=>'yiishop',
            'area'=>Qiniu::AREA_HUADONG
        ];

        $qiniu = new Qiniu($config);
        $key = microtime(true);

        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
        //echo $url;exit();

        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        exit(Json::encode($info));
    }
}