<?php

use yii\db\Migration;

/**
 * Class m180914_170036_add_table_for_cars_bodies
 */
class m180914_170036_add_table_for_cars_bodies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_body}}', [
            'id' => $this->primaryKey(),
            'body' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_body}}');
    }
}
