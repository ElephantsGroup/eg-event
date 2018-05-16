<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\event\models\EventCategoryTranslation;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventCategory */
$module = \Yii::$app->getModule('event');
$this->title = $model->name;
$translation = $model->translationByLang;
if($translation && $translation->title)
	$this->title = $translation->title;
$this->params['breadcrumbs'][] = ['label' => $module::t('event', 'Event Categories'), 'url' => ['index', 'lang'=>Yii::$app->controller->language]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a($module::t('event_cat', 'Update'), ['update', 'id' => $model->id, 'lang'=>Yii::$app->controller->language], ['class' => 'btn btn-primary']) ?>
		<?= Html::a($module::t('event_cat', 'Delete'), ['delete', 'id' => $model->id, 'lang'=>Yii::$app->controller->language], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $module::t('event', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
			[
                'attribute' => 'logo',
                'value' => EventCategory::$upload_url . $model->id . '/' . $model->logo,
                'format' => ['image'],
            ],
			[
                'attribute' => 'status',
                'value' => EventCategory::getStatus()[$model->status],
                'format' => 'raw',
            ],
		],
    ]) ?>

</div>
