<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //'title',
            [
                'label' => 'title',
                'value' => function(\app\models\Task $model){
                    return Html::a($model->title, ['task/view', 'id' => $model->id]);
                },
                'format' => 'html',
            ] ,
            'description:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            //Html::a('creator.name', ['user/view', 'id' => 'creator.id']),
            [
                'label' => "Created At",
                'value' => function(\app\models\Task $model){
                    return Html::a($model->getCreator()->select('username')->column()[0], ['user/view', 'id' => $model->creator_id]);
                },
                'format' => 'html'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

