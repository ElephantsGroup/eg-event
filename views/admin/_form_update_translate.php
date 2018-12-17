<?php
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\event\models\EventCategoryTranslation;
use elephantsGroup\event\models\Event;
use elephantsGroup\user\models\User;
use elephantsGroup\jDate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
$module = \Yii::$app->getModule('event');
?>

<div class="event-form">

	<?php
		$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
		$module_base = \Yii::$app->getModule('base');
	?>

    <?= $form->field($model, 'category_id')->dropDownList(
			ArrayHelper::map(
				EventCategory::find()
					->select(['id', EventCategoryTranslation::tableName() . '.title AS title'])
					->joinWith('translations')
					->where(['language' => Yii::$app->controller->language])
					->all(),
				'id',
				function($array, $key){ return EventCategoryTranslation::findOne(['cat_id'=>$array->id, 'language'=>Yii::$app->controller->language])->title; }
			),
		['prompt' => $module_base::t('Select Category ...')]
		)
	?>

    <?= $form->field($model, 'image_file')->label('')->fileInput() ?>

	<?= $form->field($model, 'begin_time')->widget(jDate\DatePicker::className()) ?>

	<?= $form->field($model, 'begin_time_time')->label('')->widget(TimePicker::className(), ['pluginOptions' => ['showSeconds' => true]]) ?>

	<?= $form->field($model, 'end_time')->widget(jDate\DatePicker::className()) ?>

	<?= $form->field($model, 'end_time_time')->label('')->widget(TimePicker::className(), ['pluginOptions' => ['showSeconds' => true]]) ?>

    <?= $form->field($model, 'creation_time')->widget(jDate\DatePicker::className()) ?>
	
    <?= $form->field($model, 'update_time')->widget(jDate\DatePicker::className()) ?>

    <?= $form->field($model, 'status')->dropDownList(Event::getStatus(), ['prompt' => $module_base::t('Select Status ...')]) ?>

    <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username')) ?>
	
	<?= $form->field($model, 'views')->textInput() ?>
	
	<?= $form->field($translation, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($translation, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($translation, 'description')->widget(CKEditor::className(),[
		'editorOptions' => [
			'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			'inline' => false, //по умолчанию false
			'filebrowserImageBrowseUrl' => Yii::getAlias('@web') . '/kcfinder/browse.php?type=images',
			'filebrowserImageUploadUrl' => Yii::getAlias('@web') . '/kcfinder/upload.php?type=images',
			'filebrowserBrowseUrl' => Yii::getAlias('@web') . '/kcfinder/browse.php?type=files',
			'filebrowserUploadUrl' => Yii::getAlias('@web') . '/kcfinder/upload.php?type=files',
		],
	]); 
	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $module::t('event', 'Create') : $module::t('event', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
