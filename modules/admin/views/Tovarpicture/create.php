<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TovarPicture */

$this->title = 'Create Picture for Tovar';
$this->params['breadcrumbs'][] = ['label' => 'Tovar Pictures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-picture-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
          'id_Tovar'=>$id_Tovar,
    ]) ?>

</div>
