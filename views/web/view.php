<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model harrytang\contact\models\Contact */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contact', 'Contact'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

    <div style="font-size: 0.85em; font-style: italic; margin-bottom: 10px;">
        <div>
            <?= Html::encode($model->name) ?> (<a
                href="mailto:<?= Html::encode($model->email) ?>"><?= Html::encode($model->email) ?></a>)
        </div>
        <div>
            <?= Yii::$app->formatter->format($model->created_at, 'datetime') ?>
        </div>

    </div>

    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= nl2br(Html::encode($model->content)) ?>
            </p>
        </div>
    </div>







    <p>
        <?= Html::a(Yii::t('contact', 'Reply'), 'mailto:' . Html::encode($model->email), ['class' => 'btn btn-primary']) ?>
        <?php if($model->status!=\harrytang\contact\models\Contact::STATUS_DONE):?>
        <?= Html::a(Yii::t('contact', 'Make Done'), ['done', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php endif;?>
        <?= Html::a(Yii::t('contact', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('contact', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
