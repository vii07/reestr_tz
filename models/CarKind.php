<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%car_kind}}".
 *
 * @property int $id
 * @property string $kind
 */
class CarKind extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_kind}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kind'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kind' => 'Kind',
        ];
    }
}
