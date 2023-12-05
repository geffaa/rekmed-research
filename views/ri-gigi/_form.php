<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RiGigi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ri-gigi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rm_gigi_id')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'gigi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keluhan_diagnosa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'perawatan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'is_verified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
