<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%coments}}`.
 */
class m201024_184342_create_coments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%coments}}', [
            'id' => $this->primaryKey(),
            'idUser'=>$this->integer(),
            'idTovar'=>$this->integer(),
            'coment'=>$this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%coments}}');
    }
}
