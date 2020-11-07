<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BasketuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Basketusers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basketuser-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        = or echo-->
        <? Html::a('Create Basketuser', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idUser',
            'idTovar',
            'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
