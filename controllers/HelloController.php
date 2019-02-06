<?php
/**
 * Created by PhpStorm.
 * User: Daniil
 * Date: 06.02.2019
 * Time: 18:14
 */

namespace app\controllers;


use yii\base\Controller;

class HelloController extends Controller
{
    public function actionIndex()
    {
        $message = "Hello user";
        return $this->render('index', ['message' => $message]);
    }
}