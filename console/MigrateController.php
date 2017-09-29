<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2017 Power Kernel
 */

namespace modernkernel\contact\console;
use MongoDB\BSON\UTCDateTime;
use yii\db\Query;

/**
 * Class MigrateController
 * @package modernkernel\contact\console
 */
class MigrateController extends \yii\console\Controller
{
    public function actionIndex(){
        echo "Migrating Contact...\n";
        // data
        $rows = (new Query())->select('*')->from('{{%contact_data}}')->all();
        $collection = \Yii::$app->mongodb->getCollection('contact_data');
        $collection->remove();
        foreach ($rows as $row) {
            $collection->insert([
                'name' => $row['name'],
                'email' => $row['email'],
                'subject' => $row['subject'],
                'content' => $row['content'],
                'status' => (integer)$row['status'],
                'created_at' => new UTCDateTime($row['created_at'] * 1000),
                'updated_at' => new UTCDateTime($row['updated_at'] * 1000),
            ]);
        }
        // settings
        $rows = (new Query())->select('*')->from('{{%contact_setting}}')->all();
        $collection = \Yii::$app->mongodb->getCollection('contact_settings');
        $collection->remove();
        foreach ($rows as $row) {
            $collection->insert([
                'key' => $row['key'],
                'value' => $row['value'],
            ]);
        }
        echo "Contact migration completed.\n";
    }
}