<?php

use app\models\Odontogram;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Gigi;
use yii\grid\GridView;

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

$selectedStatus = '3';
$selectedPath = Yii::getAlias('@web/svg/tooth'. $selectedStatus .'.svg');

$this->registerJs("
    var selectedStatusPath = null;
    var selectedZIndex = null;

    $(document).on('click', '.svg-container', function() {
        if (selectedStatusPath === null) {
            alert('Select sebuah simbol odontogram!');
        } else {
            var newToothPath = selectedStatusPath;
            var altValue = $(this).find('img').attr('alt');
            var idValue = $(this).find('img').attr('id');
            
            if (!$(this).find('img.clickable-tooth-overlay[src=\"' + newToothPath + '\"]').length) {
                var firstImg = $(this).find('img:first');

                // Append the new image after the first img
                if (firstImg.length) {
                    $('<img src=\"' + newToothPath + '\" id=\"' + idValue + '\" alt=\"' + altValue + '\" class=\"clickable-tooth-overlay\" style=\"display: inline; z-index=\"'+ selectedZIndex +'\"\">').insertAfter(firstImg);
                    console.log('masuk if');
                } else {
                    // If no img found, append at the end
                    $(this).append('<img src=\"' + newToothPath + '\" id=\"' + idValue + '\" alt=\"' + altValue + '\" class=\"clickable-tooth-overlay\" style=\"display: inline;\">');
                }
            }
        }
    });

    $(document).on('click', '.hoverable-row', function() {
        selectedStatusPath = $(this).attr('status-path');
        selectedZIndex = $(this).attr('z-index');
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
                    Html::img($toothPath, [
                        'id' => "tooth-$i", 
                        'alt' => "Tooth $i", 
                        'class' => 'clickable-tooth',
                        'status-gigi' => "1",
                        'z-index' => "1"
                    ]),
                    ['class' => 'svg-container', 'style' => 'display: inline-block;']
                );
            } else {
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($normalToothPath, [
                        'id' => "tooth-$i", 
                        'alt' => "Tooth $i", 
                        'class' => 'clickable-tooth',
                        'status-gigi' => "1",
                        'z-index' => "1"
                    ]),
                    ['class' => 'svg-container', 'style' => 'display: inline-block;']
                );
            }
        }
        ?>
        <br><br><br><br>

        <table class="table">
    <thead>
    </thead>
    <tbody>
        <?php $lowerLimit = 0; ?>
        <?php $upperLimit = 2;  ?>
        <?php foreach ($daftarStatusGigi as $index => $model): ?>
            <?php if ($index >= $lowerLimit && $index <= $upperLimit): ?>
                <tr class="hoverable-row" id=<?= 'status-' . $model->status_gigi_id ?> status-path=<?= Yii::getAlias('@web/'. $model->path ); ?>  z-index=<?= $model->z_index ?> >
                    <td><?= $index + 1 ?></td>
                    <td><?= $model->nama ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

    </div>
</div>

