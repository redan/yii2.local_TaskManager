<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $userList app\models\tables\Users[]*/


$this->title = 'View/change: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => \yii\helpers\Url::to(['admin-task/view', 'id' => $model->id])];
$this->params['breadcrumbs'][] = 'View/change';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['action' => Url::to(['tasks/save', 'id' => $model->id])]);?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'creator_id')->dropDownList($usersList) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'status_id')->dropDownList($taskStatuses) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(),[
                'dateFormat' => 'yyyy/MM/dd',
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>
