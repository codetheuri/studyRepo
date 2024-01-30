<?php

use app\modules\studyRepo\models\Home;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$model = Home::findOne(1);
$imagePath = $model->image; 
?>

<body>

    <!-- Navbar -->
    <!-- Add your Navbar code here -->

    <!-- Jumbotron -->
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4 p-3 mb-2 text-dark">
                <?php if ($model->heading1): ?>
                    <?= Html::encode($model->heading1) ?>
                <?php endif; ?>
            </h1>
            <p class="lead">
                <?php if ($model->opening_text): ?>
                    <?= Html::encode($model->opening_text) ?>
                <?php endif; ?>
            </p>
            <?php if (Yii::$app->user->getIsGuest()) { ?>
                <a class="btn btn-primary btn-lg" href="<?= Url::to(['studyRepo/user/login']) ?>" role="button">Get Started</a>
            <?php } ?>
        </div>
    </div>

    <!-- Single Card Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <?= Html::img($imagePath, ['alt' => 'Dynamic Image', 'class' => 'img-fluid']); ?>
                   
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode('Custom Subject') ?></h5>
                        <p class="card-text">Explore past papers for your custom subject.</p>
                        <a href="<?= Url::to(['site/indexpaper']) ?>" class="btn btn-primary">Explore</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <p>&copy; 2024 Past Papers Site</p>
    </footer>

    <!--
