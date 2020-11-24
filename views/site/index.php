<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">


    <?php $form = ActiveForm::begin();

    echo $form->field($model,'name');
    echo $form->field($model,'from');
    echo $form->field($model,'to');
    echo Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    ?>

    <?php ActiveForm::end(); ?>





    <?=$this->render('/partials/tovar', [
        'tovar'=>$tovar,
    ]);?>




</div>
