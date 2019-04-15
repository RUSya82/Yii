<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;

class TestController extends Controller
{

    public function actionIndex()
    {
        //$test = Yii::$app->test->run();
        //$product = new Product([ 'id'=> 35, 'name'=>'reebok', 'category' => 'shoose', 'price' => 350]);
        $data = \Yii::$app->db->createCommand('SELECT [[name]], [[price]], [[category]] FROM {{product}}')->queryAll();
        return $this->render('index', ['test' => $data]);
        //return $this->render('index');
        //return $this->renderContent('It is class TestController');
    }

}
