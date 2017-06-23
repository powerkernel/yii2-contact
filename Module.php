<?php

namespace modernkernel\contact;
use Yii;

/**
 * Class Module
 * @package modernkernel\contact
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modernkernel\contact\controllers';
    public $defaultRoute = 'web';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        // $this->params['foo'] = 'bar';
        // ...  other initialization code ...
        // initialize the module with the configuration loaded from config.php
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->registerTranslations();
        $this->registerMailer();
    }

    /**
     * Config Mailer for the Module
     */
    public function registerMailer()
    {
        Yii::$app->mailer->setViewPath($this->basePath . '/mail');
        Yii::$app->mailer->htmlLayout = '@common/mail/layouts/html';
    }

    /**
     * Register translation for the Module
     */
    public function registerTranslations()
    {
        if(Yii::$app->params['mongodb']['i18n']){
            $class='common\components\MongoDbMessageSource';
        }
        else {
            $class='common\components\DbMessageSource';
        }
        Yii::$app->i18n->translations['contact'] = [
            'class' => $class,
            'on missingTranslation' => function ($event) {
                $event->sender->handleMissingTranslation($event);
            },
        ];
    }

    /**
     * Translate message
     * @param $message
     * @param array $params
     * @param null $language
     * @return mixed
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::$app->getModule('contact')->translate($message, $params, $language);
    }

    /**
     * Translate message
     * @param $message
     * @param array $params
     * @param null $language
     * @return mixed
     */
    public static function translate($message, $params = [], $language = null)
    {
        return Yii::t('contact', $message, $params, $language);
    }
}
