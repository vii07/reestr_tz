<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car_service}}".
 *
 * @property int $id
 * @property int $dep_code
 * @property string $dep
 */
class CarService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_service}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dep_code'], 'integer'],
            [['dep'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dep_code' => 'Dep Code',
            'dep' => 'Dep',
        ];
    }
}
