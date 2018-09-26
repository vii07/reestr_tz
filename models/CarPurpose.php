<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car_purpose}}".
 *
 * @property int $id
 * @property string $purpose
 */
class CarPurpose extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_purpose}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purpose'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purpose' => 'Purpose',
        ];
    }
}
