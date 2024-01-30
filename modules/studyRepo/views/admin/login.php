<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\LoginForm $model */
/** @var ActiveForm $form */
?>

<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Administrative Authentication</h3>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control rounded-pill']) ?>

                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control rounded-pill']) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'form-check-input']) ?>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small text-decoration-none"><?= Html::a('Forgot password', ['user/request-password-reset']) ?>.</a>
                        <a class="small text-decoration-none"><?= Html::a('Need new verification Email? Resend', ['user/resend-verification-email']) ?></a>
                    </div>

                    <div class="form-group mt-3">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block rounded-pill', 'name' => 'login-button']) ?>
                    </div>

                    </div>
                  
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
