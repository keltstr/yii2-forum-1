<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Url;

/**
 * @property integer $id
 *
 * @property string $title
 * @property string $slug
 * @property string $description
 *
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Section[] $sections
 * @property Topic[] $topics
 *
 * @property string $url
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
            'slug' => 'Slug',
            'description' => 'Description',

            'created_at' => 'Create time',
            'updated_at' => 'Update time',
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
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['category_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['section_id' => 'id']);
    }

    public function getUrl()
    {
        $route = ['category/view', 'id' => $this->id];
        if (!empty($this->slug)) {
            $route['slug'] = $this->slug;
        }
        return Url::toRoute($route);
    }
}
