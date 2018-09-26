<?php

use yii\db\Migration;

/**
 * Class m180914_165823_add_table_for_cars_kinds
 */
class m180914_165823_add_table_for_cars_kinds extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_kind}}', [
            'id' => $this->primaryKey(),
            'kind' => $this->string(40),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_kind}}');
    }
}
