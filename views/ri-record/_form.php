<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RiRecord $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ri-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rawat_inap_id')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'subjective')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objective')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'assessment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'plan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_verified')->textInput() ?>

    <?= $form->field($model, 'is_removed')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
