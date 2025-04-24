<?php

namespace app\controllers;

use app\models\LibrosCategorias;
use app\models\LibrosCategoriasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LibrosCategoriasController implements the CRUD actions for LibrosCategorias model.
 */
class LibrosCategoriasController extends Controller
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
     * Lists all LibrosCategorias models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LibrosCategoriasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LibrosCategorias model.
     * @param int $idlibros_categorias Idlibros Categorias
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idlibros_categorias)
    {
        return $this->render('view', [
            'model' => $this->findModel($idlibros_categorias),
        ]);
    }

    /**
     * Creates a new LibrosCategorias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LibrosCategorias();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idlibros_categorias' => $model->idlibros_categorias]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LibrosCategorias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idlibros_categorias Idlibros Categorias
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idlibros_categorias)
    {
        $model = $this->findModel($idlibros_categorias);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idlibros_categorias' => $model->idlibros_categorias]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LibrosCategorias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idlibros_categorias Idlibros Categorias
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idlibros_categorias)
    {
        $this->findModel($idlibros_categorias)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LibrosCategorias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idlibros_categorias Idlibros Categorias
     * @return LibrosCategorias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idlibros_categorias)
    {
        if (($model = LibrosCategorias::findOne(['idlibros_categorias' => $idlibros_categorias])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
