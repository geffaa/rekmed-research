<?php
use yii\helpers\Html;

$this->title = 'demo2';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Your current ENVIRONMENT is : <b><?= Yii::$app->params['SATUSEHAT_ENV'] ?></b></p>
                <?php if (isset($token)) : ?>
                    <p class="mb-0">Your current token is : <b><?= Html::encode($token) ?></b></p>
                <?php endif; ?>
                <?php if (isset($statusCode)) : ?>
                    <p class="mb-0">Status Code: <b><?= Html::encode($statusCode) ?></b></p>
                <?php endif; ?>
                <?php if (isset($res)) : ?>
                    <p class="mb-0">Response : <b><?= Html::encode($res) ?></b></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
