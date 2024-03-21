<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedback';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$js = <<<JS
    $('.modalWindow').click(function(){
        console.log('oo');
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'))
    });
    $(document).on('click', '.deleteButton', function(e) {
        e.preventDefault();
        
        var confirmationMessage = $(this).data('confirm');
        var csrfToken = $(this).data('csrf');
        var url = $(this).data('url');
        
        if (confirm(confirmationMessage)) {
            var form = $('<form action="' + url + '" method="post"></form>');
            form.append('<input type="hidden" name="_csrf" value="' + csrfToken + '">');
            form.appendTo('body').submit();
        }
    });
JS;
$this->registerJs($js, yii\web\View::POS_READY);
?>
<?php
    Modal::begin([
            'header' => '<h4>Feedback</h4>',
            'id' => 'modal',
        ]);

    echo "<div id='modalContent'></div>";

    Modal::end();

?>

<div class="feedback-index">
    <p>
        <?= Html::button('Buat Feedback', ['value'=>Url::to(['feedback/create']),'class' => 'btn btn-success modalWindow']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
                if($model->is_new==1) return ['class'=>'danger'];
                else return ['class'=>''];
            },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kategori',
            'isi:html',
            'created',
            [
                'attribute' => 'user_id',
                'value' => 'user.username'
            ],

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{update} {view} {delete}',
             'buttons' => [
                'update' => function($url,$model) {
                     return Html::button('<i class="fa fa-edit"></i>', [
                            'value'=>$url,
                            'class'=>'btn dark btn-sm btn-outline sbold uppercase modalWindow',
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                },
                'delete' => function($url, $model) {
                    $confirmationMessage = Yii::t('yii', 'Apakah Anda Yakin akan menghapus Tindakan ini?');
                    $csrfToken = Yii::$app->request->csrfToken;
                    
                    return Html::a('<i class="fa fa-trash-o"></i>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Hapus'),
                        'class' => 'btn dark btn-sm btn-outline sbold uppercase deleteButton',
                        'data' => [
                            'confirm' => $confirmationMessage,
                            'csrf' => $csrfToken,
                            'url' => $url,
                        ],
                    ]);
                },
                'view' => function($url,$model) {
                    return Html::button('<i class="fa fa-mail-reply"></i>', [
                            'value'=>$url,
                            'class'=>'btn dark btn-sm btn-outline sbold uppercase modalWindow',
                            'title' => Yii::t('yii', 'Lihat'),
                            'data-pjax' => '0',
                        ]);  
                }
             ]
            ],
        ],
    ]); ?>
</div>


