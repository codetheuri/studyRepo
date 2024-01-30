<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\Paper $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="paper-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'papername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'papercode')->textInput(['maxlength' => true]) ?>
  
    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>
   
    <div class="form-group">
        <?= Html::submitButton('upload', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Back', ['/studyRepo/paper/index'],['class' => 'btn btn-secondary']) ?>
    </div>

   

    <?php ActiveForm::end(); ?>

</div>
