<?php
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventTranslation;
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\event\models\EventCategoryTranslation;
use elephantsGroup\jdf\Jdf;
use elephantsGroup\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel elephantsGroup\event\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$module = \Yii::$app->getModule('event');
$module_base = \Yii::$app->getModule('base');
$this->title = $module::t('event', 'Event List') . ' - ' . Yii::t('config', 'Company Name') . ' - ' . Yii::t('config', 'description');
$this->params['breadcrumbs'][] = $module::t('event', 'Event List');
?>
<div class="event-index">

    <h1><?= $module::t('event', 'Event List') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($module::t('event', 'Create Event'), ['create', 'lang'=>Yii::$app->controller->language], ['class' => 'btn btn-success']) ?>
    </p>

	<?php
	$module = \Yii::$app->getModule('event');
	$module_base = \Yii::$app->getModule('base');
	$columns_d = [];
	$language = array_keys($module_base->languages);

	foreach ($language as $item)
	{
		$columns_d [] = [
			'format' => 'raw',
			'label' => $module_base::t($item, 'coding'),
			'value' => function ($model) use ($module, $module_base, $item) {
				return (
				EventTranslation::findOne(['event_id'=>$model->id, 'language'=>$item])
					? Html::a($module::t('event', 'Edit'), ['/event/translation/update', 'event_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language]) .
					' / ' . Html::a($module::t('event', 'Delete'), ['/event/translation/delete', 'event_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
					: Html::a($module::t('event', 'Create'), ['/event/translation/create', 'event_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
				);
			},
		];
	}
	$columns =  [
		['class' => 'yii\grid\SerialColumn'],

		'id',
		[
			'attribute' => 'category_id',
			'format' => 'raw',
			'filter' => ArrayHelper::map(
				EventCategory::find()
					->select(['id', EventCategoryTranslation::tableName() . '.title AS title'])
					->joinWith('translations')
					->where(['language' => Yii::$app->controller->language])
					->all(),
				'id',
				function($array, $key){ return EventCategoryTranslation::findOne(['cat_id'=>$array->id, 'language'=>Yii::$app->controller->language])->title; }
			),
			'value' => function ($model) {
				$cat = EventCategory::findOne($model->category_id);
				if($cat)
					$value = $cat->name;
				else
					$value = 'Unkown';
				$translate = EventCategoryTranslation::findOne(['cat_id'=>$model->category_id, 'language'=>Yii::$app->language]);
				if($translate)
					$value = $translate->title;
				return $value;
			},
		],
		//'image',
		'views',
		//'sort_order',
		[
			'attribute' => 'author_id',
			'format' => 'raw',
			'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
			//'label' => Yii::t('user', 'Role'),
			//'sortable' => true,
			'value' => function ($model) { return User::findOne($model->author_id)->username; },
		],
		[
			'attribute' => 'status',
			'value' => function($model){
				return elephantsGroup\event\models\Event::getStatus()[$model->status];
			},
			'filter' => Html::activeDropDownList($searchModel, 'status', elephantsGroup\event\models\Event::getStatus(), ['class' => 'form-control', 'prompt' => $module_base::t('Select Status ...')])
		],
		//'update_time',
		//'creation_time',

		[
			'class' => 'yii\grid\ActionColumn',
			//'template' => '{view} {update} {delete}',
			'buttons' => [
				'view' => function ($url, $model)
				{
					$label = '<span class="glyphicon glyphicon-eye-open"></span>';
					$url = ['/event/admin/view', 'id'=>$model->id, 'lang'=>Yii::$app->controller->language];
					return Html::a($label, $url);
				},
				'update' => function ($url, $model)
				{
					$label = '<span class="glyphicon glyphicon-pencil"></span>';
					$url = ['/event/admin/update', 'id'=>$model->id, 'lang'=>Yii::$app->controller->language];
					return Html::a($label, $url);
				},
				'delete' => function ($url, $model)
				{
					$label = '<span class="glyphicon glyphicon-trash"></span>';
					$url = ['/event/admin/delete', 'id'=>$model->id, 'lang'=>Yii::$app->controller->language];
					$options = [
						'title' => Yii::t('yii', 'Delete'),
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method' => 'post'
					];
					return Html::a($label, $url, $options);
				},
			],
		],
	];

	array_splice($columns,6,0,$columns_d);
	echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>
</div>
