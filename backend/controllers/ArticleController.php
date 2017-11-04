<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4/004
 * Time: 11:30
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;

/*
 * 这是关于文章的控制器
 * */
class ArticleController extends Controller
{
    public function actionIndex()
    {
        $rows=Article::find()->all();
        return $this->render('index',['rows'=>$rows]);
    }

    //文章添加
    public function actionAdd()
    {
        $article=new Article();
        $re=new Request();
        if($re->isPost){
            $article->createtime=time();
            if($article->load($re->post()) && $article->validate()){
                $article->save();
                \Yii::$app->session->setFlash('success','添加文章成功');
                return $this->redirect(['index']);
            }else{
                \Yii::$app->session->setFlash('success','添加文章失败');
                return $this->redirect(['add']);
            }
        }
        return $this->render('add',['article'=>$article]);
    }

    //文章修改
    public function actionEdit($id)
    {
        $article=Article::findOne($id);
        $re=new Request();
        if($re->isPost){
            $article->createtime=time();
            if($article->load($re->post()) && $article->validate()){
                $article->save();
                \Yii::$app->session->setFlash('success','添加文章成功');
                return $this->redirect(['index']);
            }else{
                \Yii::$app->session->setFlash('success','添加文章失败');
                return $this->redirect(['add']);
            }
        }
        return $this->render('add',['article'=>$article]);
    }

    //文章删除
    public function actionDel($id)
    {
        $article=Article::findOne($id);
        $article->delete();
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['index']);
    }

    //文章分类添加
    public function actionCateadd()
    {
        $article=new ArticleCategory();
        $re=new Request();
        if($re->isPost){
            if($article->load($re->post()) && $article->validate()){
                $article->save();
                \Yii::$app->session->setFlash('success','添加分类成功');
                return $this->redirect(['cateindex']);
            }else{
                \Yii::$app->session->setFlash('success','添加失败');
                return $this->redirect(['cateadd']);
            }
        }
        return $this->render('cateadd',['article'=>$article]);
    }

    //文章分类添加
    public function actionCateedit($id)
    {
        $article=ArticleCategory::findOne($id);
        $re=new Request();
        if($re->isPost){
            if($article->load($re->post()) && $article->validate()){
                $article->save();
                \Yii::$app->session->setFlash('success','添加分类成功');
                return $this->redirect(['cateindex']);
            }else{
                \Yii::$app->session->setFlash('success','添加失败');
                return $this->redirect(['cateadd']);
            }
        }
        return $this->render('cateadd',['article'=>$article]);
    }

    //文章删除
    public function actionCateDel($id)
    {
        $article=Article::findOne($id);
        $article->delete();
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['Cateindex']);
    }

    public function actionCateindex()
    {
        //1.总条数
        $count = ArticleCategory::find()->count();

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
        $goods = ArticleCategory::find()->limit($page->limit)->offset($page->offset)->all();
        //显示视图
        return $this->render("cateindex", ['rows' => $goods,'page'=>$page]);
    }

}