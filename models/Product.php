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
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';
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
    public function scenarios()
    {
        return [
            self::SCENARIO_UPDATE => ['price', 'category', 'created_at'],
            self::SCENARIO_CREATE => ['name', 'price', 'category', 'created_at']
        ];
    }

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
