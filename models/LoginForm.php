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
class LoginForm extends Model
{
    public  $name;
    public  $password;
    public  $Confirmpassword;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','password','Confirmpassword'],'required'],
            [['name', 'password','Confirmpassword'], 'string', 'max' => 255],
            ['Confirmpassword','compare', 'compareAttribute'=>'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    
}
