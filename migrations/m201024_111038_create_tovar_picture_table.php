<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tovar_picture}}`.
 */
class m201024_111038_create_tovar_picture_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tovar_picture}}', [
            'id' => $this->primaryKey(),
            'id_tovar'=>$this->integer(),
            'source'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tovar_picture}}');
    }
}
