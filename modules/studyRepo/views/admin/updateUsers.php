<?php

use app\modules\studyRepo\models\Status;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yiisoft\Arrays\ArrayHelper;
use app\modules\studyRepo\models\User;

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'status')->dropDownList(
    ArrayHelper::map(User::find()->all(),'status','status'),
    ['prompt'=>'change status']
) ?>
<?= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
