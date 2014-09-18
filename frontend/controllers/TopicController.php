<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Topic;
use common\models\Category;
use common\models\Section;

class TopicController extends Controller
{
    public function actionView($id, $slug = null)
    {
        return "{$id}-{$slug}";
    }

    public function actionCreate()
    {
        $topic = new Topic();
        if ($topic->load(Yii::$app->request->post()) && $topic->save()) {
            return $this->redirect($topic->url);
        }
        $categories = Category::find()->all();
        $sections = empty($topic->category_id) ? [] : Section::findAll(['category_id' => $topic->category_id]);
        return $this->render('create', [
            'topic' => $topic,
            'categories' => $categories,
            'sections' => $sections,
        ]);
    }

    public function actionUpdate($id, $slug = null)
    {

    }

    public function actionSections($id)
    {
        $sections = Section::findAll(['category_id' => $id]);
        $items = array_merge(
            ['(choose section)'],
            ArrayHelper::map($sections, 'id', 'title')
        );
        echo Html::renderSelectOptions(null, $items);
    }
}
