<?php
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\event\models\EventTranslation;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\event\models\EventCategoryTranslation */
/* @var $form yii\widgets\ActiveForm */
$module_base = \Yii::$app->getModule('base');

?>

<div class="event-category-translation-form">

    <?php $form = ActiveForm::begin(); ?>
    
	<?php
		if(!$model->isNewRecord)
			echo $form->field($model, 'language')->dropDownList($module_base->languages, ['prompt' => Yii::t('app', 'Select Languages ...')]);
	?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('event_cat', 'Create') : Yii::t('event_cat', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
