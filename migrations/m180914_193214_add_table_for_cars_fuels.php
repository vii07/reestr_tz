<?php

use yii\db\Migration;

/**
 * Class m180914_193214_add_table_for_cars_fuels
 */
class m180914_193214_add_table_for_cars_fuels extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_fuel}}', [
            'id' => $this->primaryKey(),
            'fuel' => $this->string(80),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_fuel}}');
    }
}
