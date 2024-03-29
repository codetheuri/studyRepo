<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\Home $model */

$this->title = 'Add another Home style';
$this->params['breadcrumbs'][] = ['label' => 'Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="home-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
