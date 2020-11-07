<?php

namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $name;
    public $password;


    public function rules()
    {
        return [

            [['name','password'],'required'],
           // ['password','validatePassword'] //собственная функция для валидации пароля
        ];
    }

    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors()) // если нет ошибок в валидации
        {
            $user = $this->getUser(); // получаем пользователя для дальнейшего сравнения пароля

            if(!$user || !$user->validatePassword($this->password))
            {
                //если мы НЕ нашли в базе такого пользователя
                //или введенный пароль и пароль пользователя в базе НЕ равны ТО,
                $this->addError($attribute,'Пароль или Логін введены неверно');
                //добавляем новую ошибку для атрибута password о том что пароль или имейл введены не верно
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['name'=>$this->name]); // а получаем мы его по введенному имейлу
    }


}