<?php

namespace elephantsGroup\event\models;

use Yii;

/**
 * This is the model class for table "{{%eg_event_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property integer $status
 *
 * @property EventCategoryTranslation[] $EventCategoryTranslations
 */
class EventCategory extends \yii\db\ActiveRecord
{
    public static $_STATUS_INACTIVE = 0;
    public static $_STATUS_ACTIVE = 1;

    public static $upload_url;
	public static $upload_path;
    
	public $logo_file;


    public function init()
    {
        self::$upload_path = str_replace('/backend', '', Yii::getAlias('@webroot')) . '/uploads/eg-event/event-category/';
        self::$upload_url = str_replace('/backend', '', Yii::getAlias('@web')) . '/uploads/eg-event/event-category/';
		parent::init();
    }

    public static function getStatus()
    {
		$module = \Yii::$app->getModule('base');
        return [
            self::$_STATUS_INACTIVE => $module::t('Inactive'),
            self::$_STATUS_ACTIVE => $module::t('Active')
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_event_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'logo'], 'trim'],
            [['status'], 'integer'],
            [['name', 'logo'], 'string', 'max' => 32],
            [['status'], 'default', 'value' => self::$_STATUS_INACTIVE],
            [['logo'], 'default', 'value' => 'default.png'],
            [['status'], 'in', 'range' => array_keys(self::getStatus())],
			[['logo_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
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
            'name' => $module::t('Name'),
            'logo' => $module::t('Logo'),
            'status' => $module::t('Status'),
			'title' => $module::t('Title')
        ];
    }

	public function getTitle()
	{
		$module = \Yii::$app->getModule('base');
		$value = $module::t('Undefined');
		$translate = EventCategoryTranslation::findOne(['cat_id'=>$this->id, 'language'=>Yii::$app->language]);
		if($translate)
			$value = $translate->title;
		return $value;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
	 
	public function getEvent()
    {
        return $this->hasMany(Event::className(), ['category_id' => 'id']);
    }

    public function getTranslations()
    {
        return $this->hasMany(EventCategoryTranslation::className(), ['cat_id' => 'id']);
    }

	public function getTranslationByLang()
    {
        return $this->hasOne(EventCategoryTranslation::className(), ['cat_id' => 'id'])->where('language = :language', [':language' => Yii::$app->controller->language]);
    }
	
    public function afterSave($insert, $changedAttributes)
    {
        if($this->logo_file)
        {
            $dir = self::$upload_path . $this->id . '/';
            if(!file_exists($dir))
				mkdir($dir, 0777, true);
            $file_name = 'event-category' . $this->id . '-logo.' . $this->logo_file->extension;
            $this->logo_file->saveAs($dir . $file_name);
            $this->updateAttributes(['logo' => $file_name]);
        }
        return parent::afterSave($insert, $changedAttributes);
    }
    
	public function beforeDelete()
    {
		foreach($this->translations as $translation)
			$translation->delete();
        
		if($this->logo != 'default.png')
        {
            $file_path = self::$upload_path . $this->id . '/' . $this->logo;
            if(file_exists($file_path))
                unlink($file_path);
        }
                return parent::beforeDelete();
    }



    /**
     * @inheritdoc
     * @return EventsCategoryQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new EventsCategoryQuery(get_called_class());
    }*/
}
