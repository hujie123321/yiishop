<?php

namespace backend\controllers;

use app\models\GoodsCategory;
use foo\bar;
use tests\models\Tree;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;

class GoodsCategoryController extends Controller
{
    public function actionIndex()
    {
        $query = GoodsCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd()
    {
        $model=new GoodsCategory();
        $re=new Request();
        if($re->isPost){
            $model->load($re->post());
            if($model->validate()){
                if($model->parent_id==0){
                    $model->makeRoot();
                    \Yii::$app->session->setFlash('success','添加一级分类成功');
                }else{
                    $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);
                    $model->prependTo($cateParent);
                    \Yii::$app->session->setFlash('success','添加分类成功');
                }
            }
        }
        $cates=GoodsCategory::find()->asArray()->all();
        //var_dump($cates);exit;
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);
        return $this->render('add',['model'=>$model,'cates'=>$cates]);
    }

    public function actionEdit($id)
    {
        $model=GoodsCategory::findOne($id);
        $re=new Request();
        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);
        if($re->isPost){
            //首先取到该用户ID看看下面有没有子类
           $aa=GoodsCategory::find()->where(['parent_id'=>$id])->all();
           if(empty($aa)){
               /*
                * 如果他下面没有子类的话 要判断是不是移动到了他子类下面
                * 通过深度去比较
                * 判断不能修改到下级分类和当前分类
                * */
               //把准备修改数据的深度赋值一个变量
              $depth_a= $model->depth;
              $depth_c=$model->parent_id;
              //准备转移的那个分类的深度
               $depth_b= '';
              if($re->post()['GoodsCategory']['parent_id']==0){
                  $depth_b=0;
              }else{
                  $depth_b=GoodsCategory::findOne($re->post()['GoodsCategory']['parent_id'])->depth;
              }
              //判断不能修改到下级分类和当前分类
              if($depth_a>=$depth_b && $model->id!=$depth_c){
                  $model->load($re->post());
                  if($model->validate()){
                      if($model->parent_id==0){
                          $model->makeRoot();
                          \Yii::$app->session->setFlash('success','修改成为一级分类成功');
                          return $this->redirect('index');
                      }else{
                          $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);
                          $model->prependTo($cateParent);
                          \Yii::$app->session->setFlash('success','修改分类分类成功');
                          return $this->redirect('index');
                      }
                  }
              }else{
                  \Yii::$app->session->setFlash('success','不能修改到下级分类或者本身');
                  return $this->redirect('index');
              }

           }else{
               \Yii::$app->session->setFlash('success','分类下面有子类不能修改');
               return $this->redirect('index');
           }

        }
        return $this->render('add',['model'=>$model,'cates'=>$cates]);
    }

    public function actionDel($id)
    {
        $aa=GoodsCategory::find()->where(['parent_id'=>$id])->all();
        if(empty($aa)){
            $model=GoodsCategory::findOne($id);
            $model->delete();
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect('index');
        }else{
            \Yii::$app->session->setFlash('success','有子类不能删除');
            return $this->redirect('index');
        }
    }

    public function actionTest()
    {
        $cate=new GoodsCategory();
        $cate->name='家电';
        $cate->parent_id=0;
        $cate->makeRoot();
        var_dump($cate->getErrors());
    }

    public function actionAddChild()
    {
        $cate=new GoodsCategory();
        $cate->name='冰箱';
        $cate->parent_id=1;
        $cateParent=GoodsCategory::findOne(['id'=>$cate->parent_id]);
        $cate->prependTo($cateParent);
    }

}
