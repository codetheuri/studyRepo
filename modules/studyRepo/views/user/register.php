<?php

use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
// use kartik\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\SignupForm $model */
/** @var ActiveForm $form */

?>

<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row justify-content-center">
        <div class="col-lg-5">


            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Register</h3>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

                    <?= $form->field($model, 'username')->textInput()?>
                    <?= $form->field($model, 'email') ?>
                 
                    <?= $form->field($model, 'password')->widget(PasswordInput::class, [
                        'pluginOptions' => [
                           'showMeter' => true, 
                            'toggleMask' => true,
                        ]
                    ]) ?> 


                    <div class="form-group">
                        <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="<?= url::to(['/studyRepo/user/login']) ?>">already have an account? login!</a></div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>