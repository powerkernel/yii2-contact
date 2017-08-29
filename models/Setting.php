<?php

namespace modernkernel\contact\models;

use Yii;

/**
 * This is the model class for Setting.
 *
 * @property string $key
 * @property string $value
 */
class Setting extends SettingBase
{
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
