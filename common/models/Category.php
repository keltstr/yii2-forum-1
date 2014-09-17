<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\SluggableBehavior;

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
            ['class' => SluggableBehavior::className(), 'attribute' => 'title'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['category_id' => 'id']);
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(['category/view', 'id' => $this->id, 'slug' => $this->slug]);
    }
}
