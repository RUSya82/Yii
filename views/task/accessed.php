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
            'title',
            'description:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'label' => "Users",
                'value' => function(\app\models\Task $model){
                    return Html::a($model->getCreator()->select('username')->one()['username'], ['user/view', 'id' => $model->creator_id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

