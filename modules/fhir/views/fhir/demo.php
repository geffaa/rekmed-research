<?php
use yii\helpers\Html;

$this->title = 'demo1';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Your current ENVIRONMENT is : <b><?= Yii::$app->params['SATUSEHAT_ENV'] ?></b></p>
                <?php if (isset($token)) : ?>
                    <p class="mb-0">Your current token is : <b><?= Html::encode($token) ?></b></p>
                <?php endif; ?>
                <?php if (isset($encounter)) : ?>
                    <p class="mb-0">Your encounter example is :</p>
                    <pre><code><?= Html::encode($encounter) ?></code></pre>
                <?php endif; ?>
                <?php if (isset($condition)) : ?>
                    <p class="mb-0">Your condition example is :</p>
                    <pre><code><?= Html::encode($condition) ?></code></pre>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
