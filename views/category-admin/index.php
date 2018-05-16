<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\event\models\EventCategoryTranslation;

/* @var $this yii\web\View */
/* @var $searchModel elephantsGroup\event\models\EventCategorysearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = \Yii::$app->getModule('event');
$this->title = $module::t('event', 'Event Categories') . ' - ' . Yii::t('config', 'Company Name') . ' - ' . Yii::t('config', 'description');
$this->params['breadcrumbs'][] = $module::t('event', 'Event Categories');

?>
<div class="event-category-index">

	<h1><?= $module::t('event', 'Event Categories') ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::a($module::t('event', 'Create Event Category'), ['create', 'lang'=>Yii::$app->controller->language], ['class' => 'btn btn-success']) ?>
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
				EventCategoryTranslation::findOne(['cat_id'=>$model->id, 'language'=>$item])
					? Html::a($module::t('event', 'Edit'), ['/event/category-translation/update', 'cat_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language]) .
					' / ' . Html::a($module::t('event', 'Delete'), ['/event/category-translation/delete', 'cat_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
					: Html::a($module::t('event', 'Create'), ['/event/category-translation/create', 'cat_id'=>$model->id, 'language'=>$item, 'lang'=>Yii::$app->controller->language])
				);
			},
		];
	}

	$columns = [
		['class' => 'yii\grid\SerialColumn'],

		'id',
		'name',
		'title',
		[
			'attribute' => 'status',
			'value' => function($model){
				return elephantsGroup\event\models\EventCategory::getStatus()[$model->status];
			},
			'filter' => Html::activeDropDownList($searchModel, 'status', elephantsGroup\event\models\EventCategory::getStatus(), ['class' => 'form-control', 'prompt' => $module_base::t('Select Status ...')])
		],
		[
			'class' => 'yii\grid\ActionColumn',
			//'template' => '{view} {update} {delete}',
			'buttons' => [
				'view' => function ($url, $model)
				{
					$label = '<span class="glyphicon glyphicon-eye-open"></span>';
					$url = ['/event/category-admin/view', 'id'=>$model->id, 'lang'=>Yii::$app->controller->language];
					return Html::a($label, $url);
				},
				'update' => function ($url, $model)
				{
					$label = '<span class="glyphicon glyphicon-pencil"></span>';
					$url = ['/event/category-admin/update', 'id'=>$model->id, 'lang'=>Yii::$app->controller->language];
					return Html::a($label, $url);
				},
				'delete' => function ($url, $model)
				{
					$label = '<span class="glyphicon glyphicon-trash"></span>';
					$url = ['/event/category-admin/delete', 'id'=>$model->id, 'lang'=>Yii::$app->controller->language];
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

	array_splice($columns, 5, 0, $columns_d);
	echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

</div>
