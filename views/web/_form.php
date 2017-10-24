<?php

use himiklab\yii2\recaptcha\ReCaptcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modernkernel\contact\models\Contact */
/* @var $form yii\widgets\ActiveForm */

$js = file_get_contents(__DIR__ . '/form.min.js');
$this->registerJs($js);
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
                <?=
                Html::submitButton(
                    \modernkernel\fontawesome\Icon::widget(['icon'=>'refresh fa-spin hidden']).'<span>'.Yii::t('contact', 'Submit').'</span>',
                    ['class' => 'btn btn-primary']
                )
                ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
