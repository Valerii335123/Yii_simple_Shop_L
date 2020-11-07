<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%basket_user}}`.
 */
class m201024_184815_create_basket_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%basket_user}}', [
            'id' => $this->primaryKey(),
            'idUser'=>$this->integer(),
            'idTovar'=>$this->integer(),
            'amount'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%basket_user}}');
    }
}
