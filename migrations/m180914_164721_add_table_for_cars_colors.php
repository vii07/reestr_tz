<?php

use yii\db\Migration;

/**
 * Class m180914_164721_add_table_for_cars_colors
 */
class m180914_164721_add_table_for_cars_colors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_color}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(30),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_color}}');
    }
}
