<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tovar */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tovars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tovar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('AddFoto', ['tovarpicture/create', 'id_Tovar' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'price',
            'amount',
            'idCategory',
        ],
    ]) ?>



    <?
    foreach ($foto as $a)
    {
        echo  $foto->source;

         echo Html::img('@web/uploads/'.$a->source.'', array('height'=>'100%', 'width'=>'750'));
            echo  Html::a('Delete foto', ['tovarpicture/delete', 'id' => $a->id, 'idtovar' => $model->id],  [
                    "class"=>'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
    ]);
        echo "<br>";
    } ?>

</div>
