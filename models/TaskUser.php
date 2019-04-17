<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_user".
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 */
class TaskUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id'], 'required'],
            [['task_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\TaskUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TaskUserQuery(get_called_class());
    }
}
