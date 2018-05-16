<?php

namespace elephantsGroup\event\controllers;

use Yii;
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventTranslation;
use elephantsGroup\event\models\EventTranslationSearch;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventTranslationController implements the CRUD actions for EventTranslation model.
 */
class TranslationController extends EGController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		$behaviors = [];
		/*$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'delete' => ['post'],
			],
		];*/
		return $behaviors;
	}

    /**
     * Lists all EventTranslation models.
     * @return mixed
     
    public function actionIndex()
    {
        $searchModel = new EventTranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     *
     * Displays a single EventTranslation model.
     * @param integer $event_id
     * @param string $language
     * @return mixed
     */
    public function actionView($event_id, $language, $lang = 'fa-IR')
    {
        return $this->render('view', [
            'model' => $this->findModel($event_id, $language),
        ]);
    }

    /**
     * Creates a new EventTranslation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($event_id, $language, $lang = 'fa-IR')
    {
		$_SESSION['KCFINDER']['disabled'] = false;
		$_SESSION['KCFINDER']['uploadURL'] = Event::$upload_url .'images/';
		$_SESSION['KCFINDER']['uploadDir'] = Event::$upload_path . 'images/';

        $model = new EventTranslation();
		$model->event_id = $event_id;
		$model->language = $language;

        if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			$model->event_id = $event_id;
			$model->language = $language;
            return $this->redirect(['admin/index', 'lang' => $lang]);
        }
		else
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EventTranslation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $event_id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($event_id, $language, $lang = 'fa-IR')
    {
		
		$_SESSION['KCFINDER']['disabled'] = false;
		$_SESSION['KCFINDER']['uploadURL'] = Event::$upload_url .'images/';
		$_SESSION['KCFINDER']['uploadDir'] = Event::$upload_path . 'images/';

        $model = $this->findModel($event_id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['admin/index', 'lang' => $lang]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EventTranslation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $event_id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($event_id, $language, $lang = 'fa-IR')
    {
        $this->findModel($event_id, $language)->delete();

        return $this->redirect(['admin/index', 'lang' => $lang]);
    }

    /**
     * Finds the EventTranslation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $event_id
     * @param string $language
     * @return EventTranslation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($event_id, $language)
    {
        if (($model = EventTranslation::findOne(['event_id' => $event_id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
