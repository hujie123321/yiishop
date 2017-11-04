<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3/003
 * Time: 18:55
 */

namespace backend\controllers;


use backend\models\Brand;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;

class BrandController extends Controller
{
    public function actionIndex()
    {
        //1.总条数
        $count = Brand::find()->count();

        //2.每页显示条数
        $pageSize = 3;

        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );
        // select * from goods limit 0,3  => limit 3 offset 0
        $goods = Brand::find()->limit($page->limit)->offset($page->offset)->all();
        //显示视图
        return $this->render("index", ['brands' => $goods,'page'=>$page]);
    }

    public function actionAdd()
    {
        $brand=new Brand();
        $re=new Request();
        if($re->isPost){
            $data=$re->post();
            if($brand->load($data)){
//                $brand->imgFile=UploadedFile::getInstance($brand,'imgFile');
//                $filePath='images/'.time().".".$brand->imgFile->extension;
           // var_dump($brand->imgFile);
//                $brand->imgFile->saveAs($filePath,false);
                if($brand->validate()){
                  //  $brand->time=time();
//                    $brand->logo=$filePath;
                    $brand->save(false);
                    $this->redirect('index');
                }
            }

        }
        return $this->render('add',['brand'=>$brand]);
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
        $key = time();

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