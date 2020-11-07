<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tovar".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $price
 * @property int|null $amount
 * @property int|null $idCategory
 */
class Tovar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tovar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price', 'amount', 'idCategory'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'amount' => 'Amount',
            'idCategory' => 'Id Category',
        ];
    }
}
