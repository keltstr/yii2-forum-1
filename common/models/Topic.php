<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\SluggableBehavior;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $section_id
 *
 * @property string $title
 * @property string $slug
 * @property string $text
 *
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Section $section
 * @property Category $category
 */
class Topic extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%topic}}';
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
            'category_id' => 'Category',
            'section_id' => 'Section',

            'title' => 'Title',
            'text' => 'Text',
            'slug' => 'Slug',

            'created_at' => 'Created time',
            'updated_at' => 'Updated time',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'attributes' => [ActiveRecord::EVENT_BEFORE_INSERT => 'slug'],
            ],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}