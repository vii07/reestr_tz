<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car_color}}".
 *
 * @property int $id
 * @property string $color
 */
class CarColor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_color}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
        ];
    }
}
