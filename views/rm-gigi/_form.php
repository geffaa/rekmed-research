<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RmGigi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rm-gigi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rm_id')->textInput() ?>

    <?= $form->field($model, 'oklusi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'torus_palatinus')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'torus_mandibularis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'palatum')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'supernumerary_teeth')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'diastema')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gigi_anomali')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lain_lain')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
