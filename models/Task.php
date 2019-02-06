<?php

namespace app\models;


use yii\base\Model;

class Task extends Model
{
    public $creator;
    public $taskName;
    public $taskDescription;
    public $deadline;
    public $status;

    public function rules()
    {
        return [
            [['creator', 'taskName', 'taskDescription', 'deadline', 'status'], 'required'],
            ['status', 'boolean'],
            ['deadline', 'date'],
            [['taskName', 'taskDescription'], 'string']
        ];
    }
}