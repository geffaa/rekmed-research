<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RmGigiSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rm-gigi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'rm_gigi_id') ?>

    <?= $form->field($model, 'rm_id') ?>

    <?= $form->field($model, 'oklusi') ?>

    <?= $form->field($model, 'torus_palatinus') ?>

    <?= $form->field($model, 'torus_mandibularis') ?>

    <?php // echo $form->field($model, 'palatum') ?>

    <?php // echo $form->field($model, 'supernumerary_teeth') ?>

    <?php // echo $form->field($model, 'diastema') ?>

    <?php // echo $form->field($model, 'gigi_anomali') ?>

    <?php // echo $form->field($model, 'lain_lain') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
