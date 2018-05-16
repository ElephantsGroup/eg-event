<?php

namespace elephantsGroup\event\components;

use Yii;
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventTranslation;
use yii\base\Widget;
use yii\helpers\Html;

class ArchivedEvent extends Widget
{
	public $number = 100;
	public $language;
	public $title;
	public $subtitle;
    public $view_file = 'archived_event';

	protected $_event = [];

	public function init()
	{
		if(!isset($this->language) || !$this->language)
			$this->language = Yii::$app->language;
		if(!isset($this->title) || !$this->title)
			$this->title = Yii::t('event_params', 'Archived Events Title');
		if(!isset($this->subtitle) || !$this->subtitle)
			$this->subtitle = Yii::t('event_params', 'Archived Events Subtitle');
        if(!isset($this->view_file) || !$this->view_file)
            $this->view_file = Yii::t('event_params', 'View File');
	}

    public function run()
	{
		$event = Event::find()->archived()->orderBy(['creation_time'=>SORT_DESC])->all();
		$i = 0;
		foreach($event as $event_item)
		{
			if($i == $this->number) break;
			$translation = EventTranslation::findOne(array('event_id'=>$event_item->id, 'language'=>$this->language));
			if($translation)
			{
				$this->_event[] = [
				    'id' => $event_item['id'],
                    'image' => Event::$upload_url . $event_item['id'] . '/' . $event_item['image'],
                    'title' => $translation->title,
                    'subtitle' => $translation->subtitle
                ];
				$i++;
			}
		}
		return $this->render('archived_event', [
		    'event'=>$this->_event,
            'last_event_title'=>$this->title,
            'last_event_subtitle'=>$this->subtitle
        ]);
	}
}