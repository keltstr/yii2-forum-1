<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

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
 *
 * @property string $topic
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
        return [
            [['title', 'text'], 'trim'],
            [['title', 'text', 'category_id', 'section_id'], 'required'],
            ['title', 'string', 'min' => 5, 'max' => 255],
            ['text', 'string', 'min' => 5, 'max' => 20000],
            ['category_id', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],
            ['section_id', 'exist', 'targetClass' => Section::className(), 'targetAttribute' => 'id'],
        ];
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
            [
                'class' => TimestampBehavior::className(),
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

    public function getUrl()
    {
        $route = ['topic/view', 'id' => $this->id];
        if (!empty($this->slug)) {
            $route['slug'] = $this->slug;
        }
        return Url::toRoute($route);
    }
}
