<?php

/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2017 Power Kernel
 */


use common\Core;
use common\widgets\SideMenu;

if (!Yii::$app->user->can('staff')) {
    return [];
}


$menu=[
    'title'=>Yii::$app->getModule('contact')->t('Web Contact'),
    'icon'=> 'phone-square',
    'items'=>[
        ['icon' => 'envelope-o', 'label' => Yii::$app->getModule('contact')->t('Manage'), 'url' => ['/contact/web/index'], 'active' => Core::checkMCA('contact', 'web', ['index', 'view'])],
        ['icon' => 'gears', 'label' => Yii::$app->getModule('contact')->t('Settings'), 'url' => ['/contact/web/setting'], 'active' => Core::checkMCA('contact', 'web', 'setting')],    ],
];
$menu['active']=SideMenu::isActive($menu['items']);
return [$menu];
