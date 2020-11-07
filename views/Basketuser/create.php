<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Basketuser */

$this->title = 'Create Basketuser';
$this->params['breadcrumbs'][] = ['label' => 'Basketusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basketuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
