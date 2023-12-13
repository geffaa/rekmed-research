<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OdontogramSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="odontogram-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'odontogram_id') ?>

    <?= $form->field($model, 'rm_gigi_id') ?>

    <?= $form->field($model, 'gigi_id') ?>

    <?= $form->field($model, 'status_gigi_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
