<?php

use yii\db\Migration;

/**
 * Class m180914_192656_add_table_for_cars_purposes
 */
class m180914_192656_add_table_for_cars_purposes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_purpose}}', [
            'id' => $this->primaryKey(),
            'purpose' => $this->string(30),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_purpose}}');
    }
}
