<?php
/**
 * Created by PhpStorm.
 * User: Daniil
 * Date: 11.02.2019
 * Time: 9:02
 */

namespace app\controllers;


use app\models\filters\TasksSearch;
use app\models\tables\Tasks;
use app\models\tables\TaskStatuses;
use app\models\tables\Users;
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

    public function actionOne($id)
    {
        $model = Tasks::findOne($id);
        $usersList = Users::getUsersList();
        $taskStatuses = TaskStatuses::getStatuses();

        return $this->render('one', [
            'model' => $model,
            'usersList' => $usersList,
            'taskStatuses' => $taskStatuses,
        ]);
    }

    public function actionSave($id)
    {
        if($model = Tasks::findOne($id)){
            $model->load(\Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "Изменеия сохранены");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['search'],
                'duration' => 60,
                'variations' => [
                    \Yii::$app->language,
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM post',
                ],
            ],
        ];
    }
}