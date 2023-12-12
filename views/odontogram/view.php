<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Odontogram $model */

$this->title = 'ODONTOGRAM';
$this->params['breadcrumbs'][] = ['label' => 'Odontogram', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);

$svgPath = Yii::getAlias('@web/svg/Tooth.svg');
?>

<?php
$this->registerJsFile('https://code.jquery.com/jquery-3.6.4.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/assets/a618e4a6/yii.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>


<?php
$normalToothPath = Yii::getAlias('@web/svg/normal-tooth.svg');
$cavityToothPath = Yii::getAlias('@web/svg/cavity-tooth.svg');

$this->registerJs("
    $(document).on('click', '.svg-container', function() {
        // Replace img in container to a new img with src = cavityToothPath
        var newToothPath = '" . $cavityToothPath . "';
        $(this).find('img').replaceWith('<img src=\"' + newToothPath + '\" alt=\"New Alt Text\">');
    });
");
?>

<div class="odontogram-view">
    <div class="row">

    <?php
    $normalToothPath = Yii::getAlias('@web/svg/normal-tooth.svg');

    for ($i = 1; $i <= 8; $i++) {
        echo Html::tag(
            'div',
            Html::img($normalToothPath, ['id' => $i,'alt' => "Tooth $i", 'class' => 'clickable-tooth', 'data-tooth-id' => $i]),
            ['class' => 'svg-container']
        );
    }
    ?>


    </div>
</div>
