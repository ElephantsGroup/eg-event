<?php

namespace elephantsGroup\event\models;

use Yii;

/**
 * This is the model class for table "{{%eg_event_translation}}".
 *
 * @property integer $event_id
 * @property string $language
 * @property string $title
 * @property string $subtitle
 * @property string $description
 *
 * @property Event $event
 */
class EventTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_event_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		$module_base = \Yii::$app->getModule('base');
        return [
            [['event_id', 'language'], 'required'],
            [['event_id'], 'integer'],
            [['language', 'title'], 'trim'],
            [['language'], 'string', 'max' => 5],
            [['language'], 'default', 'value' => $module_base::$_LANG_FA],
			[['language'], 'in', 'range' => array_keys($module_base->languages)],
			[['title'], 'string', 'max' => 64],
            [['subtitle'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
		$module = \Yii::$app->getModule('event');
        return [
            'event_id' => $module::t('event', 'Event ID'),
            'language' => $module::t('event', 'Language'),
            'title' => $module::t('event', 'Title'),
            'subtitle' => $module::t('event', 'Subtitle'),
            'description' => $module::t('event', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }


    /**
     * @inheritdoc
     * @return EventTranslationQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new EventTranslationQuery(get_called_class());
    }*/
}
