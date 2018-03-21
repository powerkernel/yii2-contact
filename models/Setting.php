<?php

namespace powerkernel\contact\models;

use Yii;

/**
 * This is the model class for Setting.
 *
 * @property string $key
 * @property string $value
 */
class Setting extends \yii\mongodb\ActiveRecord
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('contact', 'Key'),
            'value' => Yii::t('contact', 'Value'),
        ];
    }

    /**
     * load as array
     * @return array
     */
    public static function loadAsArray(){
        $settings=self::find()->all();
        $a=[];
        foreach($settings as $setting)
        {
            $a[$setting->key]=$setting->value;
        }
        return $a;
    }
}
