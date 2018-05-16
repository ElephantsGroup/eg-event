<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventTranslation */

$this->title = Yii::t('event', 'Create Event Translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('event', 'Event Translations')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
