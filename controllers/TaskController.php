<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    public $defaultAction ='my';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionMy()
    {
        $query = Task::find()->byCreator(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //$dataProvider->pagination->pageSize = 5;      //число записей на странице
        return $this->render('my', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionShared()
    {
        $query = Task::find()
            ->byCreator(Yii::$app->user->id)
            ->innerJoinWith(Task::RELATION_TASK_USERS);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //$dataProvider->pagination->pageSize = 5;      //число записей на странице
        return $this->render('shared', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAccessed()
    {
        $query = Task::find()
            ->innerJoinWith(Task::RELATION_TASK_USERS)
            ->where(['user_id' => Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //$dataProvider->pagination->pageSize = 5;      //число записей на странице
        return $this->render('accessed', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $task = $this->findModel($id);
        if(!$task || (!in_array(Yii::$app->user->id, $task->getAccessedUsers()->select('id')->column()) && ($task->creator_id != Yii::$app->user->id))){
            throw new ForbiddenHttpException();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $task->getTaskUsers()
        ]);
        return $this->render('view', [
            'model' => $task
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Task created");
            return $this->redirect(['task/my', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!$model || ($model->creator_id != Yii::$app->user->id) ){
            throw new ForbiddenHttpException();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
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

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
