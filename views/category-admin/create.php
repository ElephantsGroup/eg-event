<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventCategory */

$module = \Yii::$app->getModule('event');
$this->title = $module::t('event', 'Create Event Category') . ' - ' . Yii::t('config', 'Company Name') . ' - ' . Yii::t('config', 'description');;
$this->params['breadcrumbs'][] = ['label' => $module::t('event', 'Event Categories'), 'url' => ['index', 'lang'=>Yii::$app->controller->language]];
$this->params['breadcrumbs'][] = $module::t('event', 'Create Event Category');
?>
<div class="event-category-create">
	
	<h1><?= $module::t('event', 'Create Event Category') ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
		'translation' => $translation,
    ]) ?>

</div>
