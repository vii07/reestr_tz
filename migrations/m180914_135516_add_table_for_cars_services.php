<?php

use yii\db\Migration;

/**
 * Class m180914_135516_add_table_for_cars_services
 */
class m180914_135516_add_table_for_cars_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_service}}', [
            'id' => $this->primaryKey(),
            'dep_code' => $this->integer(11),
            'dep' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_service}}');
    }
}
