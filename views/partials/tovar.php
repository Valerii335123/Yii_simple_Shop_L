<?php
use yii\helpers\Html;
?>
<style>

</style>

<ul class="products clearfix">


    <?php foreach($tovar->each() as $t):?>
    <li class="product-wrapper">



            <a class="product" href="<?=Yii::$app->homeUrl?>site/tovarview?id=<?=$t['id']?> ">
                <strong>
                    <?= $t['name'] ?>
                </strong>
                <br>

                        <?= Html::img('@web/uploads/'.$t['foto'].'', array('height'=>'100%', 'width'=>'100%'));?>
                <br>
                <p>

                    Price
                    <?= $t['price']?>
                    <br>

                    Like
                    <?= $t['like']?>
                    <br>




                    Category
                    <?= $t['c']?>
                </p>

            </a>


    </li>
    <?php endforeach;?>
</ul>



