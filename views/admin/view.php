<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\jdf\Jdf;
use elephantsGroup\user\models\User;


/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\Event */
$module = \Yii::$app->getModule('event');
$this->title = $module::t('event', 'Event id') . ' ' . $model->id;
$translation = $model->translationByLang;
if($translation && $translation->title)
	$this->title = $translation->title;
$this->params['breadcrumbs'][] = ['label' => $module::t('event', 'Event'), 'url' => ['index', 'lang'=>Yii::$app->controller->language]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a($module::t('event', 'Update'), ['update', 'id' => $model->id, 'lang'=>Yii::$app->controller->language], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($module::t('event', 'Delete'), ['delete', 'id' => $model->id, 'lang'=>Yii::$app->controller->language], [
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
			[
				'attribute'  => 'category_id',
				'value'  => EventCategory::findOne($model->category_id)->name,
				//'filter' => Lookup::items('SubjectType'),
			],
			[
                'attribute' => 'image',
                'value' => Event::$upload_url . $model->id . '/' . $model->image,
                'format' => ['image'],
            ],
			[
				'attribute'  => 'creation_time',
				'value'  => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->creation_time))->getTimestamp(), '', 'Iran', 'en'),
				//'filter' => Lookup::items('SubjectType'),
			],
			[
				'attribute'  => 'update_time',
				'value'  => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->update_time))->getTimestamp(), '', 'Iran', 'en'),
				//'filter' => Lookup::items('SubjectType'),
			],
			[
				'attribute'  => 'begin_time',
				'value'  => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->begin_time))->getTimestamp(), '', 'Iran', 'en'),
				//'filter' => Lookup::items('SubjectType'),
			],
			[
				'attribute'  => 'end_time',
				'value'  => Jdf::jdate('Y/m/d H:i:s', (new \DateTime($model->end_time))->getTimestamp(), '', 'Iran', 'en'),
				//'filter' => Lookup::items('SubjectType'),
			],
			'views',
			[
				'attribute'  => 'author_id',
				'value'  => User::findOne($model->author_id)->username,
				//'filter' => Lookup::items('SubjectType'),
			],
			[
				'attribute'  => 'status',
				'value'  => Event::getStatus()[$model->status],
				//'filter' => Lookup::items('SubjectType'),
			],
            //'sort_order',
        ],
    ]) ?>

</div>
