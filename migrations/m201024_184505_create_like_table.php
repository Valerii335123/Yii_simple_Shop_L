<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%like}}`.
 */
class m201024_184505_create_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%like}}', [
            'id' => $this->primaryKey(),
            'idUser'=>$this->integer(),
            'idTovar'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%like}}');
    }
}
