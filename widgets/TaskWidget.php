<?php
/**
 * Created by PhpStorm.
 * User: Daniil
 * Date: 11.02.2019
 * Time: 15:45
 */

namespace app\widgets;


use app\models\tables\Tasks;
use yii\base\Exception;
use yii\base\Widget;

class TaskWidget extends Widget
{
    public $model;
    public $attributes;

    public function run()
    {
        if(is_a($this->model, Tasks::class)){
            return $this->render('taskView', ['model' => $this->model]);
        }
        throw new \Exception('Error');
    }
}