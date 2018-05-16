<?php

namespace elephantsGroup\event\controllers;

use Yii;
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\event\models\EventCategorySearch;
use elephantsGroup\event\models\EventCategoryTranslation;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EventCategoryController implements the CRUD actions for EventCategory model.
 */
class CategoryAdminController extends EGController
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
     * Lists all EventCategory models.
     * @return mixed
     */
    public function actionIndex($lang = 'fa-IR')
    {
        $searchModel = new EventCategorysearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EventCategory model.
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
     * Creates a new EventCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($lang = 'fa-IR')
    {
        $model = new EventCategory();
		$translation = new EventCategoryTranslation();

        if ($model->load(Yii::$app->request->post()))
		{
			$model->logo_file = UploadedFile::getInstance($model, 'logo_file');

			if($model->save())
			{
				if ($translation->load(Yii::$app->request->post()))
				{
					if(!$translation->title)
						return $this->redirect(['view', 'id' => $model->id]);
					$translation->cat_id = $model->id;
					$translation->language = $this->language;
					if($translation->save())
						return $this->redirect(['view', 'id' => $model->id]);
				}
			}
        }
		else
		{
            return $this->render('create', [
                'model' => $model,
				'translation' => $translation,
            ]);
        }
    }

    /**
     * Updates an existing EventCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $lang = 'fa-IR')
    {
        $model = $this->findModel($id);
		$translation = EventCategoryTranslation::findOne(array('cat_id' => $id, 'language' => $this->language));

        if ($model->load(Yii::$app->request->post()))
		{
			$model->logo_file = UploadedFile::getInstance($model, 'logo_file');

			if($model->save())
			{
				if ($translation && $translation->load(Yii::$app->request->post()))
				{
					$translation->cat_id = $model->id;
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
     * Deletes an existing EventCategory model.
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
     * Finds the EventCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
