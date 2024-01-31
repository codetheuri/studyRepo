<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\password\PasswordInput;
/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\LoginForm $model */
/** @var ActiveForm $form */
?>

<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Welcome Back !</h3>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control rounded-pill']) ?>

                    <?= $form->field($model, 'password')->widget(PasswordInput::class, [
                        'pluginOptions' => [
                           'showMeter' => false, 
                            'toggleMask' => true,
                        ],
                        ])->textInput(['class' => 'form-control rounded-pill',]) ?> 

                    <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'form-check-input']) ?>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                       <?= Html::a('Forgot password', ['user/request-password-reset'],['class'=>'text-decoration-none']) ?>
                      <?= Html::a('Need new verification Email? Resend', ['user/resend-verification-email'],['class'=>'text-decoration-none']) ?>
                    </div>

                    <div class="form-group mt-3 ">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block rounded-pill', 'name' => 'login-button']) ?>
                    </div>

                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><?= Html::a('Need an account? Sign up!',['/studyRepo/user/register'],['class'=>'text-decoration-none']) ?></div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
