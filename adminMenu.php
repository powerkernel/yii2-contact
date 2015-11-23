<?php

/**
 * @author: Harry Tang (giaduy@gmail.com)
 * @link: http://www.greyneuron.com
 * @copyright: Grey Neuron
 */

use \harrytang\core\Core;
use \harrytang\contact\ContactModule;

$json=json_encode(['label'=>Yii::$app->getModule('contact')->t('Contact'), 'icon'=>'fa fa-envelope']);
return [
    $json=>[
        ['icon'=>'fa fa-circle-o', 'label' => Yii::$app->getModule('contact')->t('Manage'), 'url' => ['/contact/web/index'], 'active'=>Core::checkMCA('contact', 'web', ['index', 'view'])],
        ['icon'=>'fa fa-circle-o', 'label' => Yii::$app->getModule('contact')->t('Settings'), 'url' => ['/contact/web/setting'], 'active'=>Core::checkMCA('contact', 'web', 'setting')],
    ],
];

