<?php

namespace app\models;

use Yii;
use yii\base\model;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $password
 */
class Search extends Model
{
    public  $name;
    public  $from;
    public  $to;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['from','to'],'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */

}
