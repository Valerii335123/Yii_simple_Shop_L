<?php
use yii\helpers\Html;
?>
<style>

</style>

<ul class="products clearfix">



                //$tovar->each()
<!--    -->
//
//        //вивід всіх ключів на сторінку
//        foreach ($t as $key=>$value)
//        {
//            echo $key;
//            echo "   ";
//            echo $value;
//            echo "   ";
//        }
        echo '<br>';
//    <?php foreach($tovar->each() as $t):?>
    <li class="product-wrapper">



            <a class="product" href="site/tovarview?id=<?=$t['id']?> ">
                <strong>
                    <?= $t['name'] ?>
                </strong>
                <br>
                <br>
                <p>
                    <?= $t['description']?>
                    <br>
                    Price
                    <?= $t['price']?>
                    <br>
                    Amount
                    <?= $t['amount']?>
                    <br>
                    Category
                    <?= $t['c']?>
                </p>

            </a>


    </li>
    <?php endforeach;?>
</ul>



