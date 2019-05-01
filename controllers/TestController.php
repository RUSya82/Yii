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
use app\models\User;
use app\models\Task;

class TestController extends Controller
{

    public function actionIndex()
    {


        return $this->render('index', ['data4' => $data4]);
        //return $this->render('index');
        //return $this->renderContent('It is class TestController');
    }

    public function actionTest(){
        $task = Task::findOne(10);
        $task->title = 'TaskTest8(updated)';
        $task->description = 'TaskTest8 description(updated)';
        $task->save();
        _end($task);
    }


}
