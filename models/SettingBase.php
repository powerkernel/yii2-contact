<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2017 Power Kernel
 */


namespace powerkernel\contact\models;


use Yii;


if (Yii::$app->getModule('contact')->params['db'] === 'mongodb') {
    /**
     * Class SettingActiveRecord
     * @package common\models
     */
    class SettingActiveRecord extends \yii\mongodb\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function collectionName()
        {
            return 'contact_settings';
        }

        /**
         * @return array
         */
        public function attributes()
        {
            return [
                '_id',
                'key',
                'value',
            ];
        }

        /**
         * get id
         * @return \MongoDB\BSON\ObjectID|string
         */
        public function getId()
        {
            return $this->_id;
        }


    }
} else {
    /**
     * Class SettingActiveRecord
     * @package common\models
     */
    class SettingActiveRecord extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return '{{%contact_setting}}';
        }


    }
}

/**
 * Class SettingBase
 * @package common\models
 */
class SettingBase extends SettingActiveRecord
{
}