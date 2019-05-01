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
            //'title',
            [
                    'label' => 'title',
                    'value' => function(\app\models\Task $model){
                                return Html::a($model->title, ['task/view', 'id' => $model->id]);
                    },
                    'format' => 'html',
            ] ,
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
                    'template' => '{view} {update} {delete} {unshare}',
                    'buttons' =>[
                            'unshare' => function ($url, $model, $key){
                                $icon = \yii\bootstrap\Html::icon('remove');

                                return Html::a($icon, ['task-user/unshare-all', 'taskId' => $model->id],[
                                    'data' => [
                                        'confirm' => 'Unshare All&',
                                        'method' => 'post',
                                    ],
                                ]);
                            }
                    ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
