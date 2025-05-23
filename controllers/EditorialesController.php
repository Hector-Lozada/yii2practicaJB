<?php

namespace app\controllers;

use app\models\Editoriales;
use app\models\EditorialesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EditorialesController implements the CRUD actions for Editoriales model.
 */
class EditorialesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Editoriales models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EditorialesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Editoriales model.
     * @param int $id_editorial Id Editorial
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_editorial)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_editorial),
        ]);
    }

    /**
     * Creates a new Editoriales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Editoriales();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_editorial' => $model->id_editorial]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Editoriales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_editorial Id Editorial
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_editorial)
    {
        $model = $this->findModel($id_editorial);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_editorial' => $model->id_editorial]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Editoriales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_editorial Id Editorial
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_editorial)
    {
        $this->findModel($id_editorial)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Editoriales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_editorial Id Editorial
     * @return Editoriales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_editorial)
    {
        if (($model = Editoriales::findOne(['id_editorial' => $id_editorial])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
