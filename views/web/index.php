<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel harrytang\contact\models\search\Contact */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('contact', 'Contact');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <hr/>
    </div>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'id',
                'name',
                'email:email',
                'subject',
                ['attribute' => 'created_at', 'format' => 'dateTime'],
                ['attribute' => 'status', 'value' => function ($model) {
                    return $model->statusText;
                }, 'filter' => \harrytang\contact\models\Contact::getStatusOption()],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}{delete}'
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>

</div>
