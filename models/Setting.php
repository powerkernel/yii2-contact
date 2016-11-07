<?php

namespace modernkernel\contact\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contact_setting}}".
 *
 * @property string $key
 * @property string $value
 */
class Setting extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact_setting}}';
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
