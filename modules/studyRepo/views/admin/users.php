

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\DetailView;

$this->title = 'View Users';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="admin-view-users">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $users,
        ]),
        'columns' => [
            'id',
            'username',
            'email',
            'status',
            'role',
                    [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {delete}{update}',
                'buttons' => [
                         'delete' => function ($url, $model, $key) {
                        return Html::a('Delete', ['delete-user', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this user?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('update', ['update-user', 'id' => $model->id], [
                            'class' => 'btn btn-secondary',
                           
                        ]);
                    },
                ],

            ],
        ],
    ]); ?>

</div>
