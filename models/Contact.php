<?php

namespace modernkernel\contact\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;

/**
 * This is the model class for Contact.
 *
 * @property integer|\MongoDB\BSON\ObjectID|string $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $content
 * @property string $status
 * @property integer|\MongoDB\BSON\UTCDateTime $created_at
 * @property integer|\MongoDB\BSON\UTCDateTime $updated_at
 */
class Contact extends ContactBase
{
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_DONE = 'STATUS_DONE';

    public $verifyCode;


    /**
     * get status list
     * @param null $e
     * @return array
     */
    public static function getStatusOption($e = null)
    {
        $option = [
            self::STATUS_NEW => Yii::$app->getModule('contact')->t('New'),
            self::STATUS_DONE => Yii::$app->getModule('contact')->t('Done'),
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
                return Yii::$app->getModule('contact')->t('New');
                break;
            case self::STATUS_DONE:
                return Yii::$app->getModule('contact')->t('Done');
                break;
            default:
                return Yii::$app->getModule('contact')->t('Unknown');
                break;
        }
    }

    /**
     * color status text
     * @return mixed|string
     */
    public function getStatusColorText()
    {
        $status = $this->status;
        if ($status == self::STATUS_NEW) {
            return '<span class="label label-primary">' . $this->statusText . '</span>';
        }
        if ($status == self::STATUS_DONE) {
            return '<span class="label label-success">' . $this->statusText . '</span>';
        }
        return $this->statusText;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'content'], 'required'],

            [['content', 'status'], 'string'],
            [['name', 'email', 'subject'], 'string', 'max' => 255],
            [['email'], 'email'],

            [['verifyCode'], 'required', 'message'=> Yii::$app->getModule('contact')->t('Prove you are NOT a robot'), 'on'=>['create']],
            [['verifyCode'], ReCaptchaValidator::className(), 'message'=> Yii::$app->getModule('contact')->t('Prove you are NOT a robot'), 'on'=>['create']]
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => Yii::$app->getModule('contact')->t('ID'),
            'name' => Yii::$app->getModule('contact')->t('Name'),
            'email' => Yii::$app->getModule('contact')->t('Email'),
            'subject' => Yii::$app->getModule('contact')->t('Subject'),
            'content' => Yii::$app->getModule('contact')->t('Content'),
            'status' => Yii::$app->getModule('contact')->t('Status'),
            'created_at' => Yii::$app->getModule('contact')->t('Created At'),
            'updated_at' => Yii::$app->getModule('contact')->t('Updated At'),
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
