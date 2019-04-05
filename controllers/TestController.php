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
        $product = new Product(35, 'reebok', 'shoose', 350);
        return $this->render('index', ['product' => $product]);
        //return $this->render('index');
        //return $this->renderContent('It is class TestController');
    }

}
