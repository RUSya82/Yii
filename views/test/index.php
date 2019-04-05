<?php
/* @var $product \app\models\Product */
/* @var $this yii\web\View */
use yii\web\View;
echo "This is file 'test/index.php'<br>";

echo $product->name;
echo \yii\widgets\DetailView::widget(['model' => $product]);

