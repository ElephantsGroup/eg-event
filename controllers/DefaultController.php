<?php

namespace elephantsGroup\event\controllers;

use Yii;
//use yii\web\Controller;
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventTranslation;
use elephantsGroup\stat\models\Stat;
use elephantsGroup\base\EGController;
use elephantsGroup\jdf\Jdf;

class DefaultController extends EGController
{
	private function getBeginDate($lang, $begin_time = null)
	{
		if( $begin_time == null)
		{
			if($lang == 'fa-IR')
			{
				$date = new \DateTime();
				$now_date = Jdf::jdate('Y/m/d', time(), '', 'Iran', 'en');
				$year = (int)(substr($now_date, 0, 4));
				$month = (int)(substr($now_date, 5, 2));
				$date->setTimestamp(Jdf::jmktime(0, 0, 0, $month, 1, $year));
				$from = $date->format('Y-m-d');
			}else
			{
				$date = new \DateTime('first day of this month');
				//$date->setTimestamp();
				$date->setTimezone(new \DateTimezone('Iran'));
				$from = $date->format('Y-m-d');
			}	
			
		}else
		{
			if($lang == 'fa-IR')
			{
				$date = new \DateTime();
				$year = (int)(substr($begin_time, 0, 4));
				$month = (int)(substr($begin_time, 5, 2));
				$day = (int)(substr($begin_time, 8, 2));
				$date->setTimestamp(Jdf::jmktime(0, 0, 0, $month, $day, $year));
				$from = $date->format('Y-m-d');
			}
			else
			{
				$date = new \DateTime();
				$date->setTimezone(new \DateTimezone('Iran'));
				$begin_date = strtotime($begin_time);
				$date->setTimestamp($begin_date);
				$from = $date->format('Y-m-d');
			}
		}
		
		return $from;
	}
	
	private function getEndDate($lang, $end_time = null)
	{		
		if( $end_time == null)
		{
			if($lang == 'fa-IR')
			{
				$date=new \DateTime();
				$now_date = Jdf::jdate('Y/m/d', time(), '', 'Iran', 'en');
				$year = (int)(substr($now_date, 0, 4));
				$month = (int)(substr($now_date, 5, 2));
				$day = (int)(substr($now_date, 8, 2));
				$date->setTimestamp(Jdf::jmktime(23, 59, 59, $month, $day, $year));
				$to = $date->format('Y-m-d');
			}else
			{
				$date = new \DateTime();
				$date->setTimestamp(time());
				$date->setTimezone(new \DateTimezone('Iran'));
				$to = $date->modify('+1 day')->format('Y-m-d');
			}
		}else
		{
			if($lang == 'fa-IR')
			{
				$date=new \DateTime();
				$date->setTimezone(new \DateTimezone('Iran'));
				$year = (int)(substr($end_time, 0, 4));
				$month = (int)(substr($end_time, 5, 2));
				$day = (int)(substr($end_time, 8, 2));
				$date->setTimestamp(Jdf::jmktime(20, 29, 59, $month, $day, $year)); // TODO: fix with iran timezone later, PHP 7 jdf conflict
				$to = $date->format('Y-m-d');
			}else
			{
				$date = new \DateTime();
				$date->setTimezone(new \DateTimezone('Iran'));
				$end_date = strtotime($end_time);
				$date->setTimestamp($end_date);
				$to = $date->format('Y-m-d');
			}
			
		}
		return $to;
	}

    public function actionIndex($lang = 'fa-IR', $begin_time = null, $end_time = null)
    {
		Stat::setView('event', 'default', 'index');

        $this->layout = '//creative-item';
		Yii::$app->controller->addLanguageUrl('fa-IR', Yii::$app->urlManager->createUrl(['event', 'lang' => 'fa-IR']), (Yii::$app->controller->language !== 'fa-IR'));
		Yii::$app->controller->addLanguageUrl('en', Yii::$app->urlManager->createUrl(['event', 'lang' => 'en']), (Yii::$app->controller->language !== 'en'));
        
		$begin = $this->getBeginDate($this->language, $begin_time);
		$end = $this->getEndDate($this->language, $end_time); 
		$event_list = [];
//		$event = Event::find()->where(['between', 'creation_time', $begin, $end])->all();
		$event = Event::find()->all();
		foreach($event as $event_item)
		{
			$translation = EventTranslation::findOne(array('event_id' => $event_item->id, 'language' => $this->language));
			if($translation)
			{
				$event_list[] = [
				    'id' => $event_item['id'],
                    'thumb' => Event::$upload_url . $event_item['id'] . '/' . $event_item['image'],
                    'title' => $translation->title,
                    'subtitle' => $translation->subtitle,
                ];
			}
		}
		//var_dump($end); die;
		return $this->render('index',[
			'event' => $event_list,
			'from' => $begin,
			'to' => $end,
			'language' => $this->language
		]);
    }

    public function actionView($id, $lang = 'fa-IR')
    {
		Stat::setView('event', 'default', 'view');

        $this->layout = '//creative-item';
		Yii::$app->controller->addLanguageUrl('fa-IR', Yii::$app->urlManager->createUrl(['event/default/view', 'id'=>$id, 'lang' => 'fa-IR']), (Yii::$app->controller->language !== 'fa-IR'));
		Yii::$app->controller->addLanguageUrl('en', Yii::$app->urlManager->createUrl(['event/default/view', 'id'=>$id, 'lang' => 'en']), (Yii::$app->controller->language !== 'en'));
		$model = Event::findOne($id);
		if(!$model)
			throw new NotFoundHttpException('The requested page does not exist.');
		$model->views++;
		$model->save();
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
