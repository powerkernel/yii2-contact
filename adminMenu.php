<?php

/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2016 Modern Kernel
 */


use common\Core;

if (!Yii::$app->user->can('staff')) {
    return [];
}


return [
    ['label' => Yii::$app->getModule('contact')->t('Web Contact')],
    ['icon' => 'phone-square', 'label' => Yii::$app->getModule('contact')->t('Manage'), 'url' => ['/contact/web/index'], 'active' => Core::checkMCA('contact', 'web', ['index', 'view'])],
    ['icon' => 'map', 'label' => Yii::$app->getModule('contact')->t('Settings'), 'url' => ['/contact/web/setting'], 'active' => Core::checkMCA('contact', 'web', 'setting')],
];

