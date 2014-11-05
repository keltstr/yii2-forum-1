<?php

namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Topic;
use common\models\Category;
use common\models\Section;

/**
 * Controller class responsible for working with the forum topics.
 */
class TopicController extends Controller
{
    /**
     * Action method for displaying an existing forum topic.
     * @param integer $id of the topic to be displayed.
     * @param string|null $slug of the topic to be displayed. Default value is `null` meaning the requested topic
     * has no set slug.
     * @return string|Response action method execution result.
     */
    public function actionView($id, $slug = null)
    {
        return "{$id}-{$slug}";
    }

    /**
     * Action method for creating a new forum topic.
     * @return string|Response action method execution result.
     */
    public function actionCreate()
    {
        $topic = new Topic();
        if ($topic->load(Yii::$app->request->post()) && $topic->save()) {
            return $this->redirect($topic->url);
        }
        return $this->render('create', [
            'topic' => $topic,
            'categories' => Category::find()->all(),
            'sections' => empty($topic->category_id) ? [] : Section::findAll(['category_id' => $topic->category_id]),
        ]);
    }

    /**
     * Action method for updating an existing forum topic.
     * @param integer $id of the topic to be changed.
     * @param string|null $slug of the topic to be changed. Default value is `null` meaning the requested topic
     * has no set slug.
     */
    public function actionUpdate($id, $slug = null)
    {
    }

    /**
     * Action method for auto completion sections by the given parent category.
     * @param integer $id of the category to be used to auto complete sections.
     * @return string|Response action method execution result.
     */
    public function actionSections($id)
    {
        $sections = Section::findAll(['category_id' => $id]);
        $items = array_merge(
            ['(choose section)'],
            ArrayHelper::map($sections, 'id', 'title')
        );
        return Html::renderSelectOptions(null, $items);
    }
}
