<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\Paper $model */

$this->title = 'Add Papers';
$this->params['breadcrumbs'][] = ['label' => 'Papers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paper-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
