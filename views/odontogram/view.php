<?php

use app\components\EncryptionHelper;
use app\models\Odontogram;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Gigi;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Odontogram $model */

$this->title = 'Odontogram';
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
$selectedStatus = '3';
$selectedPath = Yii::getAlias('@web/svg/tooth'. $selectedStatus .'.svg');

$this->registerJs("
    var selectedStatusPath = null;
    var selectedZIndex = null;

    $(document).on('click', '.svg-container', function() {
        if (selectedStatusPath === null) {
            alert('Pilih sebuah simbol odontogram!');
        } else {
            var newToothPath = selectedStatusPath;
            var altValue = $(this).find('img').attr('alt');
            var idValue = $(this).find('img').attr('id');
            
            if (!$(this).find('img.clickable-tooth-overlay[src=\"' + newToothPath + '\"]').length) {
                $(this).append('<img src=\"' + newToothPath + '\" status-z-index=\"' + selectedZIndex + '\" id=\"' + idValue + '\" alt=\"' + altValue + '\" class=\"clickable-tooth-overlay\" style=\"display: inline;\">');
            }
        }
    });
    $(document).on('click', '#btn-save', function() {
        $('.clickable-tooth-overlay').each(function(index, element) {
            // Do something with each div, for example, alert its content
            alert($(element).text());
        });        
    }

    $(document).on('click', '.hoverable-row', function() {
        selectedStatusPath = $(this).attr('status-path');
        selectedZIndex = $(this).attr('z-index');

        var anchorElement = document.getElementById('selected-status-anchor');
        anchorElement.innerText = $(this).attr('status-name');
    });
");
?>

<div class="odontogram-view">
    
<div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        Odontogram
                    </div>
                </div>
                <div class="portlet-body form">

    <div class="row text-center">
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <?php
        for ($i = 21; $i <= 28; $i++) {
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <br><br><br><br><br>
    </div>
    <div class="row text-center">
    <?php
        for ($i = 55; $i >= 51; $i--) {
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <?php
        for ($i = 61; $i <= 65; $i++) {
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <br><br><br><br><br>
    </div>
    <div class="row text-center">
    <?php
        for ($i = 85; $i >= 81; $i--) {
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <?php
        for ($i = 71; $i <= 75; $i++) {
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <br><br><br><br><br>
    </div>
    <div class="row text-center">
        <?php
        for ($i = 48; $i >= 41; $i--) {
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <?php
        for ($i = 31; $i <= 38; $i++) {
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
                $gigiModel = Gigi::findByNomor($i);
                echo Html::tag(
                    'div',
                    Html::tag('div', $i, ['class' => 'tooth-label']) .
                    Html::img($gigiModel->defaultStatusGigi->path, [
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
        <br><br><br><br><br>
    </div>
    <div class="row text-right">
        <?= Html::a('Simpan', ['rm-gigi/update', 'rm_gigi_id' => EncryptionHelper::encrypt($rm_gigi_id)], ['class' => 'btn btn-circle green-haze']); ?>
        <?= Html::a('Batal', ['rm-gigi/update', 'rm_gigi_id' => EncryptionHelper::encrypt($rm_gigi_id)], ['class' => 'btn btn-circle default']); ?>
    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        Simbol Odontogram
                    </div>
                </div>
                <div class="portlet-body form">
                    Selected:<br>
                    <a href="#" class="btn btn-circle default" style="pointer-events: none;" id="selected-status-anchor">

                    </a><br><br>
                    <table class="table">
                        <thead>
                        </thead>
                        <tbody>
                            <?php $lowerLimit = 2; ?>
                            <?php $upperLimit = 20;  ?>
                            <?php foreach ($daftarStatusGigi as $index => $model): ?>
                                <?php if ($index >= $lowerLimit && $index <= $upperLimit): ?>
                                    <tr class="hoverable-row" id="<?= 'status-' . $model->status_gigi_id ?>" status-path="<?= Yii::getAlias('@web/'. $model->path ); ?>"  z-index=<?= $model->z_index ?> status-name="<?= $model->nama ?>">
                                        <td><?= Html::img($model->path, [
                                                'id' => "tooth-$i", 
                                                'alt' => "Tooth $i", 
                                                'class' => 'tooth-sample',
                                            ]); ?>
                                        </td>
                                        <td><?= $model->nama ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

