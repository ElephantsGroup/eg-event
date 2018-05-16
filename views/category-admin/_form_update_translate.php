<?php
use elephantsGroup\event\models\EventCategory;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
$module = \Yii::$app->getModule('event');
?>

<div class="event-category-form">

    <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        $module_base = \Yii::$app->getModule('base');
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo_file')->label('')->fileInput() ?>

    <?= $form->field($model, 'status')->dropDownList(EventCategory::getStatus(), ['prompt' => $module_base::t('Select Status ...')]) ?>

    <?= $form->field($translation, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $module::t('event_cat', 'Create') : $module::t('event_cat', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
