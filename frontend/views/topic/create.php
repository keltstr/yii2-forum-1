<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $topic common\models\Topic */
/* @var $categories common\models\Category[] */
/* @var $sections common\models\Section[] */

$this->registerJs(
    'yii.sectionsUrl = function (id) { return ' . Json::encode(Url::to(['topic/sections', 'id' => -1])) . '.replace("-1", id); }',
    View::POS_END
);
?>
<div class="topic-create">
    <?php $form = ActiveForm::begin(['id' => 'topic-form', 'enableClientValidation' => false]); ?>
        <?= $form->field($topic, 'title'); ?>

        <?= $form->field($topic, 'category_id')
            ->dropDownList(ArrayHelper::map($categories, 'id', 'title'), ['prompt' => '(choose category)']); ?>
        <?= $form->field($topic, 'section_id')
            ->dropDownList(ArrayHelper::map($sections, 'id', 'title'), [
                'prompt' => empty($topic->category_id) ? null : '(choose section)',
                'disabled' => empty($topic->category_id),
            ]); ?>

        <?= $form->field($topic, 'text')->textarea(); ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
