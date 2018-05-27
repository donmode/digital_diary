<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "my_day".
 *
 * @property integer $id
 * @property string $date
 * @property string $til
 * @property string $description
 * @property string $file
 * @property string $created_at
 * @property string $modified_at
 */
class MyDay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'til', 'description', 'file', 'created_at'], 'required'],
            [['date', 'created_at', 'modified_at'], 'safe'],
            [['description'], 'string'],
            [['til'], 'string', 'max' => 255],
            [['file'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'til' => 'Til',
            'description' => 'Description',
            'file' => 'File',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
