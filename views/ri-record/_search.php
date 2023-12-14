<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RiRecordSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ri-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ri_record_id') ?>

    <?= $form->field($model, 'rawat_inap_id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'subjective') ?>

    <?= $form->field($model, 'objective') ?>

    <?php // echo $form->field($model, 'assessment') ?>

    <?php // echo $form->field($model, 'plan') ?>

    <?php // echo $form->field($model, 'is_verified') ?>

    <?php // echo $form->field($model, 'is_removed') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
