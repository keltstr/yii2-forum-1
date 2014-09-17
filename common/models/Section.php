<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\SluggableBehavior;

/**
 * @property integer $id
 * @property integer $category_id
 *
 * @property string $title
 * @property string $slug
 * @property string $description
 *
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 *
 * @property string $url
 */
class Section extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%section}}';
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(['section/view', 'id' => $this->id, 'slug' => $this->slug]);
    }
}
