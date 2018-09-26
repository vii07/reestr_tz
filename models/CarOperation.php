<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car_operation}}".
 *
 * @property int $id
 * @property int $oper_code
 * @property string $oper_name
 */
class CarOperation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_operation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oper_code'], 'integer'],
            [['oper_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oper_code' => 'Oper Code',
            'oper_name' => 'Oper Name',
        ];
    }
}
