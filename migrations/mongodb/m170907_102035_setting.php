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
        $this->insert('contact_settings', ['key' => 'address', 'value' => 'address']);
        $this->insert('contact_settings', ['key' => 'city', 'value' => 'city']);
        $this->insert('contact_settings', ['key' => 'country', 'value' => 'country']);
        $this->insert('contact_settings', ['key' => 'phone', 'value' => 'phone']);
        $this->insert('contact_settings', ['key' => 'latLng', 'value' => 'latLng']);
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
