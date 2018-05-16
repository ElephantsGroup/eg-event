<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel elephantsGroup\event\models\EventTranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Translations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-translation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::a('Create Event Translation', ['create', 'lang'=>Yii::$app->controller->language], ['class' => 'btn btn-success']) ?>
    </p>
	
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'event_id',
            'language',
            'title',
            'subtitle',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>
