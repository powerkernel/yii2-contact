<?php

/**
 * @author: Harry Tang (giaduy@gmail.com)
 * @link: http://www.greyneuron.com
 * @copyright: Grey Neuron
 */

use \harrytang\core\Core;
use \harrytang\contact\ContactModule;

$json=json_encode(['label'=>'Contact', 'icon'=>'fa fa-envelope']);
return [
    $json=>[
        ['icon'=>'fa fa-list', 'label' => ContactModule::t('Manage'), 'url' => ['/contact/web/index'], 'active'=>Core::checkMCA('contact', 'web', ['index', 'view'])],
        ['icon'=>'fa fa-cog', 'label' => ContactModule::t('Settings'), 'url' => ['/contact/web/setting'], 'active'=>Core::checkMCA('contact', 'web', 'setting')],
    ],
];

