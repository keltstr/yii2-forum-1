<?php

namespace frontend\components;

use yii\web\UrlRule;
use common\models\Category;

class CategoryUrlRule extends UrlRule
{
    public function init()
    {
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'category/view') {
            if (isset($params['id'], $params['slug'])) {
                return $params['id'] . '-' . $params['slug'];
            } elseif (isset($params['id'])) {
                return $params['id'];
            }
        }
        return false;
    }

    public function parseRequest($manager, $request)
    {
        /* @var Category $category */
        $pathInfo = $request->getPathInfo();
        if (($pos = strpos($pathInfo, '-')) === false && is_numeric($pathInfo)) {
            $category = Category::find()
                ->where('id = :id', array(':id' => $pathInfo))
                ->andWhere('slug = "" OR slug IS NULL')
                ->one();
        } elseif ($pos !== false && is_numeric($id = substr($pathInfo, 0, $pos))) {
            $category = Category::findOne([
                'id' => $id,
                'slug' => substr($pathInfo, $pos + 1),
            ]);
        }
        if (isset($category)) {
            return ['category/view', ['id' => $category->id, 'slug' => $category->slug]];
        }
        return false;
    }
}
