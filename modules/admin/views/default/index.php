<?php
use yii\helpers\Html;
//print_r($model);
foreach ($model as $m) {
    echo '<li>';
    echo $m->id;
    echo ': ';
    echo $m->name;
    echo '</li>';
    echo ': ';
    echo html::a('delete or ban',['deleteuser','id'=>$m->id]);
    echo '<br>';
}

?>