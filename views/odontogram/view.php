<?php

use app\models\Odontogram;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Gigi;

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

$this->registerCssFile("@web/css/odontogram.css");
?>

<?php
$normalToothPath = Yii::getAlias('@web/svg/tooth1.svg');

$selectedStatus = 3;
$selectedPath = Yii::getAlias('@web/svg/tooth'. $selectedStatus .'.svg');

$this->registerJs("
    $(document).on('click', '.svg-container', function() {
        var newToothPath = '" . $selectedPath . "';
        var altValue = $(this).find('img').attr('alt');
        var idValue = $(this).find('img').attr('id');
        $(this).append('<img src=\"' + newToothPath + '\" id=\"' + idValue + '\" alt=\"' + altValue + '\" class=\"clickable-tooth-overlay\" style=\"display: inline;\">');
    });
");
?>

<div class="odontogram-view">
    <div class="row">
        <?php
        for ($i = 18; $i >= 11; $i--) {
            // Cek jika ada model odontogram di dataProvider dengan gigi_id == $i
            $matchingModel = Odontogram::findInDataProvider($i, $dataProvider);

            if ($matchingModel !== null) {
                $toothPath = Yii::getAlias('@web/svg/tooth' . $matchingModel->statusGigi->status_gigi_id . '.svg');
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($toothPath, ['id' => "tooth-$i", 'alt' => "Tooth $i", 'class' => 'clickable-tooth']),
                    ['class' => 'svg-container', 'style' => 'display: inline-block;']
                );
            } else {
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($normalToothPath, ['id' => "tooth-$i", 'alt' => "Tooth $i", 'class' => 'clickable-tooth']),
                    ['class' => 'svg-container', 'style' => 'display: inline-block;']
                );
            }
        }
        ?>
    </div>
</div>

