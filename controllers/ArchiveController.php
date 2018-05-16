<?php

namespace elephantsGroup\event\controllers;

//use yii\web\Controller;
use elephantsGroup\base\EGController;
use elephantsGroup\stat\models\Stat;

class ArchiveController extends EGController
{
    public function actionIndex($lang = 'fa-IR')
    {
		Stat::setView('event', 'archive', 'index');
		
		$this->layout = '//main';
        return $this->render('index');
    }
}
