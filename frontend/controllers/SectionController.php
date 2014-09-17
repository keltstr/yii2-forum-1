<?php

namespace frontend\controllers;

use yii\web\Controller;

class SectionController extends Controller
{
    public function actionView($id, $slug = null)
    {
        return "{$id}-{$slug}";
    }
}
