<?php

/**
 * @author: Harry Tang (giaduy@gmail.com)
 * @link: http://www.greyneuron.com
 * @copyright: Grey Neuron
 */

use \harrytang\core\Core;
use \harrytang\contact\ContactModule;

return [
    'Contact'=>[
        ['label' => ContactModule::t('Manage'), 'url' => ['/contact/web/index'], 'active'=>Core::checkMCA('contact', 'web', ['index', 'view'])],
        ['label' => ContactModule::t('Settings'), 'url' => ['/contact/web/setting'], 'active'=>Core::checkMCA('contact', 'web', 'setting')],
    ],
];

