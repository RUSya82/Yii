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
        //$data = \Yii::$app->db->createCommand('SELECT [[name]], [[price]], [[category]] FROM {{product}}')->queryAll();
//        $data = \Yii::$app->db->createCommand()->insert('user', [
//            'username' => 'Anton',
//            'password_hash' => '2df68sd45f6df8g2q3lp',
//            'creator_id' => 35,
//            'created_at' =>time(),
//        ])->execute();
        $data = \Yii::$app->db->createCommand()->insert('user', [
            'username' => 'Marat',
            'password_hash' => '65d689d5rd1df8g2q3lp',
            'creator_id' => 35,
            'created_at' =>time(),
        ])->execute();
        $data = \Yii::$app->db->createCommand()->insert('user', [
            'username' => 'Ubuntu',
            'password_hash' => '86g689d5rdf5f8g2q5tg',
            'creator_id' => 35,
            'created_at' =>time(),
        ])->execute();
        //var_dump($data);
        return $this->render('index', ['test' => $data]);
        //return $this->render('index');
        //return $this->renderContent('It is class TestController');
    }

}
