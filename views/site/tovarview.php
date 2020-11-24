<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use \yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $model app\models\Tovar */
/* @var $form ActiveForm */
?>

<div class="tovar-view" >

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            'price',


        ],
    ]) ?>

        <?
    $coment->idUser=Yii::$app->user->id;
    $coment->idTovar=$model->id;
        $basket->idUser=$coment->idUser;
        $basket->idTovar=$coment->idTovar;
    ?>
    <?
     if (!Yii::$app->user->isGuest) {
        $fo = ActiveForm::begin();
        echo $fo->field($basket, 'amount')->input('number', [
            'min' => 0, 'max' => 9999,
        ]);

        echo $fo->field($basket, 'idTovar')->hiddenInput()->label(false);

        echo html::submitButton('Add to basket', ['class' => 'btn btn-primary']);
        ActiveForm::end();
    }
    ?>

            <? if (!Yii::$app->user->isGuest) {
        $form = ActiveForm::begin();
        echo $form->field($coment, 'idUser')->hiddenInput()->label(false);
        echo $form->field($coment, 'idTovar')->hiddenInput()->label(false);
        echo $form->field($coment, coment);
        echo html::submitButton('Add', ['class' => 'btn btn-primary']);
        ActiveForm::end();
                echo html::a('Like',['like','idT'=>$model->id],['class' => 'btn btn-primary']);
                echo html::label($like);
    }
    ?>




    <?
    foreach ($foto as $a)
    {
        echo  $foto->source;

        echo Html::img('@web/uploads/'.$a->source.'', array('height'=>'100%', 'width'=>'100%'));

        echo "<br>";
    } ?>


    <?php
    foreach ($comentsUser as $com) {
                echo '<h3> User </h3>';
                echo $com['u'];
        echo '<h3>Coment </h3>';
                echo $com['c'];

                 echo '<pre></pre>';
        }
        echo LinkPager::widget([
                'pagination' => $pages,
        ]);
    ?>



</div><!-- tovarview -->
