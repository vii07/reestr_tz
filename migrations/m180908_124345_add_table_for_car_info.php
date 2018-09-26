<?php

use yii\db\Migration;

/**
 * Class m180908_124345_add_table_for_car_info
 */
class m180908_124345_add_table_for_car_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_info}}', [
            'id' => $this->primaryKey(),
            'person' => $this->string(1),
            'reg_addr_koatuu' => $this->string(10),
            'oper_code' => $this->integer(11),
            'd_reg' => $this->date(),
            'dep_code' => $this->integer(11),
            'brand' => $this->string(80),
            'model' => $this->string(80),
            'make_year' => $this->smallInteger(4),
            'color' => $this->tinyInteger(2),
            'kind' => $this->tinyInteger(2),
            'body' => $this->smallInteger(5),
            'purpose' => $this->tinyInteger(2),
            'fuel' => $this->tinyInteger(2),
            'capacity' => $this->integer(10),
            'own_weight' => $this->integer(10),
            'total_weight' => $this->integer(10),
            'n_reg_new' => $this->string(10),
        ]);

        $this->createIndex('car_info_n_reg_new', '{{%car_info}}', 'n_reg_new');
        $this->createIndex('car_info_unique_1', '{{%car_info}}', [
            'n_reg_new', 'make_year', 'dep_code', 'd_reg', 'oper_code'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_info}}');
    }
}
