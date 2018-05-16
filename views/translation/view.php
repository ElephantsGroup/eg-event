<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\event\models\EventTranslation;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventTranslation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('event', 'Event Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-translation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('event_cat', 'Update'), ['update', 'event_id' => $model->event_id, 'language' => $model->language, 'lang'=>Yii::$app->controller->language], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('event_cat', 'Delete'), ['delete', 'event_id' => $model->event_id, 'language' => $model->language, 'lang'=>Yii::$app->controller->language], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php 
	$module_base = \Yii::$app->getModule('base');
	echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'event_id',
            [
				'attribute'  => 'language',
				'value'  => $module_base->languages()[$model->language],
				//'filter' => Lookup::items('SubjectType'),
			],
            'title',
            'subtitle',
            'description:ntext',
        ],
    ]) ?>

</div>
