<?php

namespace elephantsGroup\event\models;

use Yii;

/**
 * This is the model class for table "{{%eg_event_category_translation}}".
 *
 * @property integer $cat_id
 * @property string $language
 * @property string $title
 *
 * @property EventCategory $cat
 */
class EventCategoryTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_event_category_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		$module_base = \Yii::$app->getModule('base');
        return [
            [['cat_id', 'language'], 'required'],
            [['cat_id'], 'integer'],
            [['language', 'title'], 'trim'],
            [['language'], 'string', 'max' => 5],
			[['language'], 'default', 'value' => Yii::$app->language],
			[['language'], 'in', 'range' => array_keys($module_base->languages)],
            [['title'], 'string', 'max' => 32],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
		$module = \Yii::$app->getModule('base');
        return [
            'cat_id' => $module::t('Cat ID'),
            'language' => $module::t('Language'),
            'title' => $module::t('Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(EventsCategory::className(), ['id' => 'cat_id']);
    }

    /**
     * @inheritdoc
     * @return EventCategoryTranslationQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new EventCategoryTranslationQuery(get_called_class());
    }*/
}
