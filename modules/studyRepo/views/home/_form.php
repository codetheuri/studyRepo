<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\Home $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="home-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'heading1')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'opening_text')->textarea(['rows' => 3]) ?>
    
    <?=$form->field($model, 'image')->fileInput()?>

 


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
