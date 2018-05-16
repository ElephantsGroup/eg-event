<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventsCategory */
$module = \Yii::$app->getModule('event');
$this->title = $module::t('event', 'Update Event Category') . ' ' . $model->name . ' - ' . Yii::t('config', 'Company Name') . ' - ' . Yii::t('config', 'description');
$this->params['breadcrumbs'][] = ['label' => $module::t('event', 'Event Categories'), 'url' => ['index', 'lang'=>Yii::$app->controller->language]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'lang'=>Yii::$app->controller->language]];
$this->params['breadcrumbs'][] = $module::t('event', 'Update');
?>
<div class="event-category-update">

    <h1><?= $module::t('event', 'Update Event Category') . ' ' . $model->name ?></h1>

    <?php
		if($translation)
			echo
				$this->render('_form_update_translate', [
					'model' => $model,
					'translation' => $translation,
				]);
		else
			echo
				$this->render('_form_update', [
					'model' => $model,
				]);
	?>

</div>
