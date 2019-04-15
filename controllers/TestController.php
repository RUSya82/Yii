<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
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
//        $data = \Yii::$app->db->createCommand()->insert('user', [
//            'username' => 'Marat',
//            'password_hash' => '65d689d5rd1df8g2q3lp',
//            'creator_id' => 35,
//            'created_at' =>time(),
//        ])->execute();
//        $data = \Yii::$app->db->createCommand()->insert('user', [
//            'username' => 'Ubuntu',
//            'password_hash' => '86g689d5rdf5f8g2q5tg',
//            'creator_id' => 35,
//            'created_at' =>time(),
//        ])->execute();

        $query = new Query();
        $data = $query->from('user')->select('*')->where(['id' => 1])->one();
        $query2 = new Query();
        $data2 = $query2->from('user')
            ->select('*')
            ->where(['>','id','1'])
            ->orderBy('username')
            ->all();
        $query3 = new Query();
        $data3 = $query3->from('user')->select('count(*)')->one();
        return $this->render('index', ['data' => $data, 'data2' => $data2, 'data3' => $data3]);
        //return $this->render('index');
        //return $this->renderContent('It is class TestController');
    }

}
