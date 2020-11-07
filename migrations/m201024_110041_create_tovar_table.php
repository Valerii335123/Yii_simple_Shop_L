<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tovar}}`.
 */
class m201024_110041_create_tovar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tovar}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'description'=>$this->text(),
            'price'=>$this->integer(),
            'amount'=>$this->integer(),
            'idCategory'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tovar}}');
    }
}
