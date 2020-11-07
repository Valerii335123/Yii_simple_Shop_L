<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property int $id
 * @property int|null $idUser
 * @property int|null $idTovar
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idTovar'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'Id User',
            'idTovar' => 'Id Tovar',
        ];
    }
}
