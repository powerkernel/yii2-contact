<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */

/* @var $this \yii\web\View */
/* @var $settings [] */
?>
<div class="widget-info">

    <div>
        <abbr title="<?= Yii::$app->getModule('contact')->t('Address') ?>"
              class="glyphicon glyphicon-map-marker"></abbr>
        <?= $settings['address'] ?><br/>
        <?= $settings['city'] ?>, <?= $settings['country'] ?>
    </div>

    <div>
        <abbr title="<?= Yii::$app->getModule('contact')->t('Phone') ?>" class="glyphicon glyphicon-phone-alt"></abbr>
        <?= $settings['phone'] ?>
    </div>

</div>