<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coments".
 *
 * @property int $id
 * @property int|null $idUser
 * @property int|null $idTovar
 * @property string|null $coment
 */
class Coments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idTovar'], 'integer'],
            [['coment'], 'string'],
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
            'coment' => 'Coment',
        ];
    }
}
