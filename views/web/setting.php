<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $models[] powerkernel\contact\models\Setting */

$this->title = Yii::t('contact', 'Settings');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="contact-setting">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <?php foreach ($models as $model) : ?>
                <div class="form-group">
                    <label for="<?= $model->key ?>"><?= Yii::$app->getModule('contact')->t(ucfirst($model->key)) ?></label>
                    <input type="<?= $model->key=='mapApi'?'password':'text' ?>" class="form-control" id="<?= $model->key ?>" name="<?= $model->key ?>"
                           placeholder="<?= Yii::$app->getModule('contact')->t(ucfirst($model->key)) ?>" value="<?= $model->value ?>"/>
                </div>
            <?php endforeach; ?>

            <div class="form-group">
                <?= \common\components\SubmitButton::widget(['text'=>Yii::t('contact', 'Save'), 'options'=>['class' => 'btn btn-primary']]) ?>
            </div>

            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>

</div>