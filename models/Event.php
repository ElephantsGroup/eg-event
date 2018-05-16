<?php

namespace elephantsGroup\event\models;

use Yii;

/**
 * This is the model class for table "{{%eg_event}}".
 *
 * @property integer $id
 * @property string $image
 * @property integer $sort_order
 * @property integer $status
 * @property string $update_time
 * @property string $creation_time
 *
 * @property EventTranslation[] $EventTranslations
 */
class Event extends \yii\db\ActiveRecord
{
	public $image_file;
    public $begin_time_time;
    public $end_time_time;

    public static $_STATUS_SUBMITTED = 0;
    public static $_STATUS_CONFIRMED = 1;
    public static $_STATUS_REJECTED = 2;
    public static $_STATUS_ARCHIVED = 3;

    public static $upload_url;
	public static $upload_path;

    public function init()
    {
		self::$upload_path = str_replace('/backend', '', Yii::getAlias('@webroot')) . '/uploads/eg-event/event/';
        self::$upload_url = str_replace('/backend', '', Yii::getAlias('@web')) . '/uploads/eg-event/event/';
        parent::init();
    }

    public static function getStatus()
    {
        $module = \Yii::$app->getModule('base');
        return array(
            self::$_STATUS_SUBMITTED => $module::t('Submitted'),
            self::$_STATUS_CONFIRMED => $module::t('Confirmed'),
            self::$_STATUS_REJECTED => $module::t('Rejected'),
            self::$_STATUS_ARCHIVED => $module::t('Archived'),
        );
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_event}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'views', 'author_id', 'sort_order', 'status'], 'integer'],
            [['update_time', 'creation_time', 'begin_time', 'end_time'], 'date', 'format'=>'php:Y-m-d H:i:s'],
            [['begin_time_time', 'end_time_time'], 'string', 'max' => 11],
            [['image'], 'string', 'max' => 32],
            [['sort_order'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => self::$_STATUS_SUBMITTED],
            [['update_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['image'], 'default', 'value' => 'default.png'],
            [['status'], 'in', 'range' => array_keys(self::getStatus())],
			[['image_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
		$module = \Yii::$app->getModule('base');
        return [
			'id' => $module::t('ID'),
            'category_id' => $module::t('Category ID'),
            'begin_time' => $module::t('Begin Time'),
            'end_time' => $module::t('End Time'),
            'creation_time' => $module::t('Creation Time'),
            'update_time' => $module::t('Update Time'),
            'views' => $module::t('Views'),
            'image' => $module::t('Image'),
            'author_id' => $module::t('Author ID'),
            'status' => $module::t('Status'),
			'title' => $module::t('Title'),
            'sort_order' => $module::t('Sort Order'),
        ];
    }
	
	public function getTitle()
	{
		$module = \Yii::$app->getModule('base');
		$value = $module::t('Undefined');
		$translate = EventTranslation::findOne(['event_id'=>$this->id, 'language'=>Yii::$app->language]);
		if($translate)
			$value = $translate->title;
		return $value;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getCategory()
    {
        return $this->hasOne(EventCategory::className(), ['id' => 'category_id']);
    }

    public function getTranslations()
    {
        return $this->hasMany(EventTranslation::className(), ['event_id' => 'id']);
    }
	
	public function getTranslationByLang()
    {
        return $this->hasOne(EventTranslation::className(), ['event_id' => 'id'])->where('language = :language', [':language' => Yii::$app->controller->language]);
    }
	
    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->setTimezone(new \DateTimezone('Iran'));
        $this->update_time = $date->format('Y-m-d H:i:s');
        if($this->isNewRecord)
            $this->creation_time = $date->format('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }
	public function afterSave($insert, $changedAttributes)
    {
        if($this->image_file)
        {
			$dir = self::$upload_path . $this->id . '/';
			if(!file_exists($dir))
				mkdir($dir, 0777, true);
            $file_name = 'event-' . $this->id . '.' . $this->image_file->extension;
            $this->image_file->saveAs($dir . $file_name);
            $this->updateAttributes(['image' => $file_name]);
        }
        return parent::afterSave($insert, $changedAttributes);
    }

	public function beforeDelete()
	{
		foreach($this->translations as $translation)
			$translation->delete();

		if($this->image != 'default.png')
		{
			$file_path = self::$upload_path . $this->id . '/' . $this->image;
			if(file_exists($file_path))
				unlink($file_path);
		}
		return parent::beforeDelete();
	}




    /**
     * @inheritdoc
     * @return EventsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }
}
