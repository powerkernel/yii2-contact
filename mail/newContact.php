<?php

use \yii\helpers\Html;

/* @var $model \powerkernel\contact\models\Contact */

?>
<p><?= Yii::$app->getModule('contact')->t('Hello Admin,') ?></p>

<p>
    <?= Yii::$app->getModule('contact')->t('{USER} ({EMAIL}) have contacted you via web email system with the following message:', [
        'USER' => Html::encode($model->name),
        'EMAIL' => Html::encode($model->email)]) ?>
</p>

<p><?= $model->subject ?></p>
<p><?= nl2br(Html::encode($model->content)) ?></p>