<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventCategoryTranslation */

$this->title = Yii::t('event_cat', 'Create Event Category Translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('event_cat', 'Event Category Translations')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-category-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
