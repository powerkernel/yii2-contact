<?php

use harrytang\contact\ContactModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model harrytang\contact\models\Setting */

$this->title = Yii::t('contact', 'Settings');
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="contact-setting">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <hr/>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($models as $model) : ?>
        <div class="form-group">
            <label for="<?= $model->key ?>"><?= ContactModule::t(ucfirst($model->key)) ?></label>
            <input type="text" class="form-control" id="<?= $model->key ?>" name="<?= $model->key ?>" placeholder="<?= ContactModule::t(ucfirst($model->key)) ?>" value="<?= $model->value ?>" />
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('contact', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>

</div>