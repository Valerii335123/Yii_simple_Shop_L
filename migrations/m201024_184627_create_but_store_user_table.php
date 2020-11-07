<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%but_store_user}}`.
 */
class m201024_184627_create_but_store_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%but_store_user}}', [
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
        $this->dropTable('{{%but_store_user}}');
    }
}
