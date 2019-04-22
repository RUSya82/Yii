<?php

namespace app\controllers;

use app\models\Task;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionTest(){
//        $user = new User([
//            'username' => 'Kristy',
//            'password_hash' => '56ds6dgfg544g44huyuol6',
//            'auth_key' => '5d6fe65e',
//            'creator_id' => 8,
//            'created_at' => time()
//        ]);
//        $user->save();
//        echo $user->id;
//        $task = new Task(['title' => 'tasktest 1', 'description' => 'Task Test №1', 'created_at' => time() ]);
//        $task->link(Task::RELATION_CREATOR, $user);
//        var_dump($task);
//        $task = new Task(['title' => 'tasktest 2', 'description' => 'Task Test №2', 'created_at' => time() ]);
//        $task->link(Task::RELATION_CREATOR, $user);
//        var_dump($task);
//        $task = new Task(['title' => 'tasktest 3', 'description' => 'Task Test №3', 'created_at' => time() ]);
//        $task->link(Task::RELATION_CREATOR, $user);
//        var_dump($task);
          //Жадная без JOIN
          $users = User::find()->with(User::RELATION_TASKS)->all();
          foreach ($users as $user){
              //var_dump($user->tasks);
              echo "user ID: $user->id,  user name: $user->username, created tasks: <br>";
              foreach ($user->tasks as $task){
                  echo "task ID: $task->id,   task name: $task->title, ";
              }
              echo "<br>";
          }
          // JOIN
            $users = User::find()->joinWith(User::RELATION_TASKS)->all();
            foreach ($users as $user){
                //var_dump($user->tasks);
                echo "user ID: $user->id,  user name: $user->username, created tasks: <br>";
                foreach ($user->tasks as $task){
                    echo "task ID: $task->id,   task name: $task->title, ";
                }
                echo "<br>";
            }

    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
