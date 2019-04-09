<?php


namespace app\components;


use yii\base\Component;

class TestService extends Component
{
    public $property = '123321';

    public function run(){
        return $this->property;
    }
}