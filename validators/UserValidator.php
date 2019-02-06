<?php

namespace app\validators;


use yii\validators\Validator;
use Yii;

class UserValidator extends Validator
{
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} must be username.');
        }
    }

    protected function validateValue($value)
    {
        $sql = 'SELECT {$value} FROM users';
        if($sql){
            return null;
        }
    }
}