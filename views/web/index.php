<?php

use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel powerkernel\contact\models\search\Contact */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('contact', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs('$(document).on("pjax:send", function(){ $(".grid-view-overlay").removeClass("hidden");});$(document).on("pjax:complete", function(){ $(".grid-view-overlay").addClass("hidden");})');
?>
<div class="contact-index">

    <div class="box box-primary">
        <div class="box-body">

            <div class="table-responsive">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'name',
                        'email:email',
                        'subject',
                        [
                            'attribute' => 'created_at',
                            'value' => 'createdAt',
                            'format' => 'dateTime',
                            'filter' => DatePicker::widget(['model' => $searchModel, 'attribute' => 'created_at', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]),
                            'contentOptions'=>['style'=>'min-width: 80px']
                        ],
                        ['attribute' => 'status', 'value' => function ($model) {
                            return $model->statusColorText;
                        }, 'filter' => \powerkernel\contact\models\Contact::getStatusOption(), 'format'=>'raw'],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}{delete}'
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>

        </div>
        <!-- Loading (remove the following to stop the loading)-->
        <div class="overlay grid-view-overlay hidden">
            <?= \powerkernel\fontawesome\Icon::widget(['name'=>'sync', 'styling'=>'fa-spin']) ?>
        </div>
        <!-- end loading -->
    </div>

</div>
