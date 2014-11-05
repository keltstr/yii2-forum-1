<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\web\Response;
use yii\web\HttpException;
use common\models\Category;

/**
 * Controller class responsible for working with categories.
 */
class CategoryController extends Controller
{
    /**
     * Action method for viewing a single forum category.
     * @param integer $id of the forum category to be shown.
     * @param string|null $slug of the forum category to be shown. Default value is `null` meaning the requested topic
     * has no set slug.
     * @return string|Response action method execution result.
     * @throws HttpException in case category cannot be found.
     */
    public function actionView($id, $slug = null)
    {
        $category = Category::findOne($slug === null ? $id : ['id' => $id, 'slug' => $slug]);
        if ($category === null) {
            throw new HttpException(404, 'Cannot find requested forum category!');
        }
        return $this->render('view', ['category' => $category]);
    }
}
