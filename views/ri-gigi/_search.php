<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RiGigiSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ri-gigi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ri_gigi_id') ?>

    <?= $form->field($model, 'rm_gigi_id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'gigi') ?>

    <?= $form->field($model, 'keluhan_diagnosa') ?>

    <?php // echo $form->field($model, 'perawatan') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'is_verified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
