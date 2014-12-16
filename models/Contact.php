<?php

namespace harrytang\contact\models;

use harrytang\contact\ContactModule;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%contact_web}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Contact extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 10;
    const STATUS_DONE = 20;

    public $verifyCode;


    /**
     * get status list
     * @param null $e
     * @return array
     */
    public static function getStatusOption($e = null)
    {
        $option = [
            self::STATUS_NEW => ContactModule::t('New'),
            self::STATUS_DONE => ContactModule::t('Done'),
        ];
        if (is_array($e))
            foreach ($e as $i)
                unset($option[$i]);
        return $option;
    }

    /**
     * get user status
     * @param null $status
     * @return string
     */
    public function getStatusText($status = null)
    {
        if ($status === null)
            $status = $this->status;
        switch ($status) {
            case self::STATUS_NEW:
                return ContactModule::t('New');
                break;
            case self::STATUS_DONE:
                return ContactModule::t('Done');
                break;
            default:
                return ContactModule::t('Unknown');
                break;
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'content'], 'required'],
            [['content'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'email', 'subject'], 'string', 'max' => 255],

            ['verifyCode', 'captcha', 'captchaAction'=>'/site/captcha', 'on'=>['create']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('contact', 'ID'),
            'name' => Yii::t('contact', 'Name'),
            'email' => Yii::t('contact', 'Email'),
            'subject' => Yii::t('contact', 'Subject'),
            'content' => Yii::t('contact', 'Content'),
            'status' => Yii::t('contact', 'Status'),
            'created_at' => Yii::t('contact', 'Created At'),
            'updated_at' => Yii::t('contact', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($insert) {
            $this->status = self::STATUS_NEW;
        }
        return true;
    }
}
