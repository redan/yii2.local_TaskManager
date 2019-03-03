<?php

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('css/tasks.css');

$model = \app\models\tables\Tasks::find()->all();
?>
    <p>
        <?= \yii\helpers\Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
                'tag' => 'div',
                'class' => 'tasks_container'
                ],
        'layout' => "{items}\n{pager}",
        'itemView' => function($model)
        {
            return \app\widgets\TaskWidget::widget(['model' => $model]);
        },
    ])?>