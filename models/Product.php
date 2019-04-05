<?php


namespace app\models;

use Yii;
use yii\base\Model;

class Product extends Model
{
    public $id;
    public $name;
    public $category;
    public $price;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $category
     * @param $price
     */
    public function __construct($id, $name, $category, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }


}