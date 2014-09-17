<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * @property integer $id
 *
 * @property string $title
 * @property string $description
 *
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Section[] $sections
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',

            'title' => 'Title',
            'description' => 'Description',

            'created_at' => 'Create time',
            'updated_at' => 'Update time',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['category_id' => 'id']);
    }
}
