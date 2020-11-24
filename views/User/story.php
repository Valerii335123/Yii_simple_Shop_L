<?php

use yii\helpers\Html;

use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\User */

?>



<!---->
<?//= GridView::widget([
//    'dataProvider' => $model,
//    'filterModel' => $search,
//    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
//
//        'id',
//        'idUser',
//        'idTovar',
//
//        'amount',
//
//
//        ['class' => 'yii\grid\ActionColumn'],
//    ],
//]); ?>
<?php foreach($model as $t):?>
<!--        </p>  --><?//= $t->id?>
<!--       </p> --><?//= $t->idUser?>
        Id Tovar     =  <?= $t->idTovar?>
            Amount<?= $t->amount?>
    <pre></pre>


<?php endforeach;?>
