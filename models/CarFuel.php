<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car_fuel}}".
 *
 * @property int $id
 * @property string $fuel
 */
class CarFuel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_fuel}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fuel'], 'string', 'max' => 20],
            [['fuel'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fuel' => 'Fuel',
        ];
    }
}
