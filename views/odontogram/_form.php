<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Odontogram $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="odontogram-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rm_gigi_id')->textInput() ?>

    <?= $form->field($model, 'gigi_id')->textInput() ?>

    <?= $form->field($model, 'status_gigi_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
