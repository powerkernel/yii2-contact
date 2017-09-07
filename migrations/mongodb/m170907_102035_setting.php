<?php

/**
 * Class m170907_102035_setting
 */
class m170907_102035_setting extends \yii\mongodb\Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $col=Yii::$app->mongodb->getCollection('contact_settings');
        $col->createIndexes([
            [
                'key'=>['key'],
                'unique'=>true,
            ]
        ]);
    }

    /**
     * @return bool
     */
    public function down()
    {
        echo "m170907_102035_setting cannot be reverted.\n";

        return false;
    }
}
