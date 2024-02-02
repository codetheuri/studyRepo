<?php
use app\modules\studyRepo\models\Paper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\PaperSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Papers';

?>
<div class="paper-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'papername',
            'unit',
            'papercode',
            'created_at', // Format the date
            [
                'attribute' => 'file',
                'format' => 'raw',
                // 'target' => 'blank',
                'value' => function ($model) {
                    return Html::a('Download', ['studyRepo/paper/download', 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

</div>
