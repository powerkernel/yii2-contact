<?php

use \harrytang\contact\ContactModule;
use \yii\helpers\Html;

/* @var $model \harrytang\contact\models\Contact */

?>
<p><?= ContactModule::t('Hello Admin,') ?></p>

<p>
    <?= ContactModule::t('{USER} ({EMAIL}) have contacted you via web email system with the following message:', [
        'USER' => Html::encode($model->name),
        'EMAIL' => Html::encode($model->email)]) ?>
</p>

<p><?= $model->subject ?></p>
<p><?= nl2br(Html::encode($model->content)) ?></p>

<?= ContactModule::t('Sincerely,') ?><br/>
<?= Html::encode(\Yii::$app->name) ?>