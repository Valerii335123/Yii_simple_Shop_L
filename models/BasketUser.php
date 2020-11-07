<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "basket_user".
 *
 * @property int $id
 * @property int|null $idUser
 * @property int|null $idTovar
 * @property int|null $amount
 */
class BasketUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basket_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idTovar', 'amount'], 'integer'],
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
            'amount' => 'Amount',
        ];
    }
}
