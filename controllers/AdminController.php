<?php

namespace elephantsGroup\event\controllers;

use Yii;
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventSearch;
use elephantsGroup\event\models\EventTranslation;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use elephantsGroup\jdf\Jdf;


/**
 * EventController implements the CRUD actions for Event model.
 */
class AdminController extends EGController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex($lang = 'fa-IR')
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $lang = 'fa-IR')
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($lang = 'fa-IR')
    {
		$_SESSION['KCFINDER']['disabled'] = false;
		$_SESSION['KCFINDER']['uploadURL'] = Event::$upload_url .'images/';
		$_SESSION['KCFINDER']['uploadDir'] = Event::$upload_path . 'images/';

        $model = new Event();
		$translation = new EventTranslation();

        if ($model->load(Yii::$app->request->post()))
        {
            $datetime = $model->begin_time;
            $time = $model->begin_time_time;
            $year = (int)(substr($datetime, 0, 4));
            $month = (int)(substr($datetime, 5, 2));
            $day = (int)(substr($datetime, 8, 2));
            $hour = (int)(substr($time, 0, 2));
            $minute = (int)(substr($time, 3, 2));
            $second = (int)(substr($time, 6, 2));
            if(substr($time, 9, 2) == 'PM')
                $hour += 12;
            $date = new \DateTime();
            $date->setTimestamp(Jdf::jmktime($hour, $minute, $second, $month, $day, $year));
            $model->begin_time = $date->format('Y-m-d H:i:s');

            $datetime = $model->end_time;
            $time = $model->end_time_time;
            $year = (int)(substr($datetime, 0, 4));
            $month = (int)(substr($datetime, 5, 2));
            $day = (int)(substr($datetime, 8, 2));
            $hour = (int)(substr($time, 0, 2));
            $minute = (int)(substr($time, 3, 2));
            $second = (int)(substr($time, 6, 2));
            if(substr($time, 9, 2) == 'PM')
                $hour += 12;
            $date = new \DateTime();
            $date->setTimestamp(Jdf::jmktime($hour, $minute, $second, $month, $day, $year));
            $model->end_time = $date->format('Y-m-d H:i:s');

            $model->author_id = (int) Yii::$app->user->id;
			$model->image_file = UploadedFile::getInstance($model, 'image_file');

			if($model->save())
			{
				if ($translation->load(Yii::$app->request->post()))
				{
					$translation->event_id = $model->id;
					$translation->language = $this->language;
					if($translation->save())
						return $this->redirect(['view', 'id' => $model->id]);					
				}
			}
        }
		else
		{
            return $this->render('create',[
                'model' => $model,
				'translation' => $translation,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $lang = 'fa-IR')
    {
		$_SESSION['KCFINDER']['disabled'] = false;
		$_SESSION['KCFINDER']['uploadURL'] = Event::$upload_url .'images/';
		$_SESSION['KCFINDER']['uploadDir'] = Event::$upload_path . 'images/';

        $model = $this->findModel($id);
        $translation = EventTranslation::findOne(array('event_id' => $id, 'language' => $this->language));

        date_default_timezone_set('Iran');

        $timestamp = (new \DateTime($model->begin_time))->getTimestamp();
        $hour = Jdf::jdate('h', $timestamp, '', 'Iran', 'en');
        $minute = Jdf::jdate('i', $timestamp, '', 'Iran', 'en');
        $second = Jdf::jdate('s', $timestamp, '', 'Iran', 'en');
        $type = 'AM';
        $model->begin_time_time = $hour . ':' . $minute . ':' . $second . ' ' . $type;
        $model->begin_time = Jdf::jdate('Y/m/d', $timestamp, '', 'Iran', 'en');

        $timestamp1 = (new \DateTime($model->end_time))->getTimestamp();
        $hour = Jdf::jdate('h', $timestamp, '', 'Iran', 'en');
        $minute = Jdf::jdate('i', $timestamp, '', 'Iran', 'en');
        $second = Jdf::jdate('s', $timestamp, '', 'Iran', 'en');
        $type = 'AM';
        $model->end_time_time = $hour . ':' . $minute . ':' . $second . ' ' . $type;
        $model->end_time = Jdf::jdate('Y/m/d', $timestamp1, '', 'Iran', 'en');

        if ($model->load(Yii::$app->request->post()))
        {
            $datetime = $model->begin_time;
            $time = $model->begin_time_time;
            $year = (int)(substr($datetime, 0, 4));
            $month = (int)(substr($datetime, 5, 2));
            $day = (int)(substr($datetime, 8, 2));
            $hour = (int)(substr($time, 0, 2));
            $minute = (int)(substr($time, 3, 2));
            $second = (int)(substr($time, 6, 2));
            if(substr($time, 9, 2) == 'PM')
                $hour += 12;
            $date = new \DateTime();
            $date->setTimestamp(Jdf::jmktime($hour, $minute, $second, $month, $day, $year));
            $model->begin_time = $date->format('Y-m-d H:i:s');

            $datetime = $model->end_time;
            $time = $model->end_time_time;
            $year = (int)(substr($datetime, 0, 4));
            $month = (int)(substr($datetime, 5, 2));
            $day = (int)(substr($datetime, 8, 2));
            $hour = (int)(substr($time, 0, 2));
            $minute = (int)(substr($time, 3, 2));
            $second = (int)(substr($time, 6, 2));
            if(substr($time, 9, 2) == 'PM')
                $hour += 12;
            $date = new \DateTime();
            $date->setTimestamp(Jdf::jmktime($hour, $minute, $second, $month, $day, $year));
            $model->end_time = $date->format('Y-m-d H:i:s');

            $model->author_id = (int) Yii::$app->user->id;
			$model->image_file = UploadedFile::getInstance($model, 'image_file');

			if($model->save())
			{
				if ($translation && $translation->load(Yii::$app->request->post()))
				{
					if(!$translation->title && !$translation->subtitle && !$translation->intro && !$translation->description)
						return $this->redirect(['view', 'id' => $model->id]);
					$translation->event_id = $model->id;
					$translation->language = $this->language;
					if($translation->save())
						return $this->redirect(['view', 'id' => $model->id]);					
				}
				return $this->redirect(['view', 'id' => $model->id]);					
			}
        }
		else
		{
            return $this->render('update', [
                'model' => $model,
				'translation' => $translation,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
