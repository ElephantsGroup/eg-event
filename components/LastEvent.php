<?php

namespace elephantsGroup\event\components;

use Yii;
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventTranslation;
use yii\base\Widget;
use yii\helpers\Html;

class LastEvent extends Widget
{
	public $number = 3;
	public $language;
	public $title;
	public $subtitle;
	public $title_is_link = true;
	public $event_title_is_link = true;
	public $show_global_more = false;
	public $global_more_text = '';
	public $show_archive_button = false;
	public $archive_button_text = '';
    public $view_file = 'last_event';

	protected $_event = [];

	public function init()
	{
		if(!isset($this->language) || !$this->language)
			$this->language = Yii::$app->language;
		if(!isset($this->title) || !$this->title)
			$this->title = Yii::t('event_params', 'Last Event Title');
		if(!isset($this->subtitle))
			$this->subtitle = Yii::t('event_params', 'Last Event Subtitle');
		if(!isset($this->global_more_text))
			$this->global_more_text = Yii::t('event_params', 'Global More Text');
		if(!isset($this->archive_button_text))
			$this->archive_button_text = Yii::t('event_params', 'Archive Button Text');
        if(!isset($this->view_file) || !$this->view_file)
            $this->view_file = Yii::t('event_params', 'View File');
	}

    public function run()
	{
		$event = Event::find()->confirmed()->orderBy(['creation_time'=>SORT_DESC])->all();
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
                    'subtitle' => $translation->subtitle];
				$i++;
			}
		}

		return $this->render($this->view_file, [
			'event' => $this->_event,
			'last_event_title' => $this->title,
			'last_event_subtitle' => $this->subtitle,
			'title_is_link' => $this->title_is_link,
			'event_title_is_link' => $this->event_title_is_link,
			'language' => $this->language,
			'show_global_more' => $this->show_global_more,
			'global_more_text' => $this->global_more_text,
			'show_archive_button' => $this->show_archive_button,
			'archive_button_text' => $this->archive_button_text,
		]);
	}
}