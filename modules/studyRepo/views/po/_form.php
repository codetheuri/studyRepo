<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var app\modules\studyRepo\models\Po $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="po-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'po_id')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-envelope"></i> Po items</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelspoItem[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'po_item_no',
                    'quantity',
                 
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelspoItem as $i => $modelpoItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">po items</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelpoItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelpoItem, "[{$i}]id");
                            }
                        ?>
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelpoItem, "[{$i}]po_item_no")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelpoItem, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
