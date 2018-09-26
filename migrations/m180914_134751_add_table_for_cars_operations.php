<?php

use yii\db\Migration;

/**
 * Class m180914_134751_add_table_for_cars_operations
 */
class m180914_134751_add_table_for_cars_operations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_operation}}', [
            'id' => $this->primaryKey(),
            'oper_code' => $this->smallInteger(5),
            'oper_name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_operation}}');
    }
}
