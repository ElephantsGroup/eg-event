<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\Event */
$module = \Yii::$app->getModule('event');
$this->title = $module::t('event', 'Create Event') . ' - ' . Yii::t('config', 'Company Name') . ' - ' . Yii::t('config', 'description');
$this->params['breadcrumbs'][] = ['label' => $module::t('event', 'Event'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Yii::t('event', 'Create Event') ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
		'translation' => $translation,
    ]) ?>


</div>
