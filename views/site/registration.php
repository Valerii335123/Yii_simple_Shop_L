<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\models\LoginForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */
?>
<div class="registration">

	<?php 
	if($isHave)
	{
		$mess='<p>Такий користувач вже існує</p>';
		echo $mess;
	}
	 ?>
	
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    	<?= $form->field($model, 'Confirmpassword')->passwordInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- registration -->
