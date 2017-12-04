<?php

use himiklab\yii2\recaptcha\ReCaptcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model powerkernel\contact\models\Contact */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="contact-form">
    <p>
        <?= Yii::t('contact', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.') ?>
    </p>

    <div class="row">
        <div class="col-xs-12">

            <?php $form = ActiveForm::begin(['options' => ['class' => 'pds']]); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'subject')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'verifyCode')->widget(ReCaptcha::className())->label(false) ?>

            <div class="form-group">
                <?= \common\components\SubmitButton::widget(['text'=>Yii::t('contact', 'Submit'), 'options'=>['class' => 'btn btn-primary']]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
