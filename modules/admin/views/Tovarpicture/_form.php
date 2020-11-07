<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TovarPicture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-picture-form">

    <?php $form = ActiveForm::begin(); ?>
  <?$model->id_tovar = $id_Tovar?>
    <?echo ($model->id_tovar)?>
    
    <?= $form->field($model, 'source')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
