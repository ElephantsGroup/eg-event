<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventCategoryTranslation */
$this->title = Yii::t('event_cat', 'Update Event Category Translation') . ' : ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Category Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'cat_id' => $model->cat_id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = Yii::t('event_cat', 'Update');
?>
<div class="event-category-translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
