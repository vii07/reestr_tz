<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car_info}}".
 *
 * @property int $id
 * @property string $person
 * @property string $reg_addr_koatuu
 * @property int $oper_code
 * @property string $d_reg
 * @property int $dep_code
 * @property string $brand
 * @property string $model
 * @property int $make_year
 * @property int $color
 * @property int $kind
 * @property int $body
 * @property int $purpose
 * @property int $fuel
 * @property int $capacity
 * @property int $own_weight
 * @property int $total_weight
 * @property string $n_reg_new
 */
class CarInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oper_code', 'dep_code', 'make_year', 'color', 'kind', 'body', 'purpose', 'fuel', 'capacity', 'own_weight', 'total_weight'], 'integer'],
            [['d_reg'], 'safe'],
            [['person'], 'string', 'max' => 1],
            [['reg_addr_koatuu', 'n_reg_new'], 'string', 'max' => 10],
            [['brand', 'model'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person' => 'Person',
            'reg_addr_koatuu' => 'Reg Addr Koatuu',
            'oper_code' => 'Oper Code',
            'd_reg' => 'D Reg',
            'dep_code' => 'Dep Code',
            'brand' => 'Brand',
            'model' => 'Model',
            'make_year' => 'Make Year',
            'color' => 'Color',
            'kind' => 'Kind',
            'body' => 'Body',
            'purpose' => 'Purpose',
            'fuel' => 'Fuel',
            'capacity' => 'Capacity',
            'own_weight' => 'Own Weight',
            'total_weight' => 'Total Weight',
            'n_reg_new' => 'N Reg New',
        ];
    }
}
