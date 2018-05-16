<?php

namespace elephantsGroup\event\controllers;

use Yii;
use elephantsGroup\event\models\EventCategoryTranslation;
use elephantsGroup\event\models\EventCategoryTranslationSearch;
use elephantsGroup\base\EGController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventCategoryTranslationController implements the CRUD actions for EventCategoryTranslation model.
 */
class CategoryTranslationController extends EGController
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
		return $behaviors;    }

    /**
     * Lists all EventCategoryTranslation models.
     * @return mixed
     
    public function actionIndex()
    {
        $searchModel = new EventCategoryTranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    *
     * Displays a single EventCategoryTranslation model.
     * @param integer $cat_id
     * @param string $language
     * @return mixed
     */
    public function actionView($cat_id, $language, $lang = 'fa-IR')
    {
        return $this->render('view', [
            'model' => $this->findModel($cat_id, $language),
        ]);
    }

    /**
     * Creates a new EventCategoryTranslation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cat_id, $language, $lang = 'fa-IR')
    {
        $model = new EventCategoryTranslation();
		
        $model->cat_id = $cat_id;
		$model->language = $language;

        if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			$model->cat_id = $cat_id;
			$model->language = $language;
            return $this->redirect(['category-admin/index', 'lang' => $lang]);
        }
		else
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EventCategoryTranslation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $cat_id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($cat_id, $language, $lang = 'fa-IR')
    {
        $model = $this->findModel($cat_id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['category-admin/index', 'lang' => $lang]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EventCategoryTranslation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $cat_id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($cat_id, $language, $lang = 'fa-IR')
    {
        $this->findModel($cat_id, $language)->delete();

        return $this->redirect(['category-admin/index', 'lang' => $lang]);
    }

    /**
     * Finds the EventCategoryTranslation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $cat_id
     * @param string $language
     * @return EventCategoryTranslation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cat_id, $language)
    {
        if (($model = EventCategoryTranslation::findOne(['cat_id' => $cat_id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
