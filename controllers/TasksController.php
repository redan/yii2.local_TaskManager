<?php
/**
 * Created by PhpStorm.
 * User: Daniil
 * Date: 11.02.2019
 * Time: 9:02
 */

namespace app\controllers;


use app\models\filters\TasksSearch;
use app\models\forms\TaskAttachmentsAddForm;
use app\models\tables\TaskComments;
use app\models\tables\Tasks;
use app\models\tables\TaskStatuses;
use app\models\tables\Users;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

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
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
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

    public function actionAddComment()
    {
        $model = new TaskComments();
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            \Yii::$app->session->setFlash('success', "Комментарий добавлен");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }
        $this->redirect(\Yii::$app->request->referrer);

    }

    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->file = UploadedFile::getInstance($model, 'file');
        if($model->save()){
            \Yii::$app->session->setFlash('success', "Файл добавлен");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }
}