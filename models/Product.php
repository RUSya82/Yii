<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property string $category
 * @property int $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

//    public function scenarios()
//    {
//        return [
//            self::SCENARIO_DEFAULT => ['name']
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['category'], 'string', 'on'=>'update', 'max' => 10],
            [['category'], 'string', 'on'=>'create', 'max' => 20],
            [['name'], 'string', 'max' => 20],
            [['name'], 'filter', 'filter' => 'trim'],
            [['name'], 'filter', 'filter' => function($val){
                return strip_tags($val);
            }],
            [['price'], 'integer', 'max' => 1000, 'min' => 0],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'category' => 'Category',
            'created_at' => 'Created At',
        ];
    }
}
