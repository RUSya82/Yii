<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shared Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'title',
            'description:ntext',
            [
                    'label' => "Users",
                    'value' => function(\app\models\Task $model){
                                $values = $model->getAccessedUsers()->all();
                               // _end($values);
                                $data = [];
                                foreach ($values as $value){
                                    $data[] = Html::a($value->username, ['user/view', 'id' => $value->id]);
                                }
                                return join(', ' , $data);
                    },
                    'format' => 'html'
            ],
            'created_at:datetime',
            'updated_at:datetime',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {share}',
                    'buttons' =>[
                            'share' => function ($url, $model, $key){
                                $icon = \yii\bootstrap\Html::icon('share');

                                return Html::a($icon, ['task-user/create', 'taskId' => $model->id]);
                            }
                    ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
