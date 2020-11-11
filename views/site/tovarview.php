<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tovar */
/* @var $form ActiveForm */
?>
<div class="tovarview">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            'price',
            'amount',

        ],
    ]) ?>

    <?= html::a('Add to basket',['addtobasket','id_tovar'=>$model->id]);
        $form=ActiveForm::begin();
        $form->field('count','count');
    ?>

    <?
    foreach ($foto as $a)
    {
        echo  $foto->source;

        echo Html::img('@web/uploads/'.$a->source.'', array('height'=>'100%', 'width'=>'100%'));

        echo "<br>";
    } ?>




</div><!-- tovarview -->
