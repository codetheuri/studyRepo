<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AdminAsset;

AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

  

    <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>
<body class="bg-success">

    <main class="container-fluid">
        <?= $content ?>
    </main>


</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage(); ?>
