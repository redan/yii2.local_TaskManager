<?php
/**
 * Created by PhpStorm.
 * User: Daniil
 * Date: 11.02.2019
 * Time: 9:02
 */

namespace app\controllers;


use app\models\filters\TasksSearch;
use yii\web\Controller;
use Yii;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}