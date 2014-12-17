<?php

use yii\db\Schema;
use yii\db\Migration;

class m141217_054516_setting extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contact_setting}}', [
            'key' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
        ], $tableOptions);

        $this->addPrimaryKey('pk', '{{%contact_setting}}', 'key');
        $this->insert('{{%contact_setting}}', ['key'=>'address', 'value'=>'address']);
        $this->insert('{{%contact_setting}}', ['key'=>'city', 'value'=>'city']);
        $this->insert('{{%contact_setting}}', ['key'=>'country', 'value'=>'country']);
        $this->insert('{{%contact_setting}}', ['key'=>'phone', 'value'=>'phone']);
        $this->insert('{{%contact_setting}}', ['key'=>'latLng', 'value'=>'latLng']);
    }

    public function down()
    {
        $this->dropTable('{{%contact_setting}}');
    }
}
