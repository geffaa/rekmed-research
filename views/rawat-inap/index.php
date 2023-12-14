<?php

use app\models\RawatInap;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RawatInapSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rawat Inaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawat-inap-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rawat Inap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rawat_inap_id',
            'mr',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RawatInap $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'rawat_inap_id' => $model->rawat_inap_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
