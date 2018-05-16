<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventsTranslation */
$this->title = Yii::t('event', 'Update Event Translation') . ' : ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'event_id' => $model->event_id, 'language' => $model->language, 'lang'=>Yii::$app->controller->language]];
$this->params['breadcrumbs'][] = Yii::t('event', 'Update');
?>
<div class="event-translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
