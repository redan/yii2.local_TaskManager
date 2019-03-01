<?php


namespace app\commands;


use app\models\tables\Tasks;
use yii\console\Controller;
use yii\console\ExitCode;

class MailController extends Controller
{
    public function actionMailDead()
    {
        $model = Tasks::find()->where(['<','DATEDIFF(now(), deadline)', 2])->all();
        foreach ($model as $value){
            \Yii::$app->mailer->compose()
                ->setTo($value->responsible)
                ->setFrom('test@test.ru')
                ->setSubject('Сроки вашей задачи!')
                ->setTextBody("Ваша задача скоро должна быть завершена {$value->name}")
                ->send();
        }
    }
}