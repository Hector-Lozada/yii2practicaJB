<?php

namespace app\controllers;

use app\models\Libros;
use app\models\LibrosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

/**
 * LibrosController implements the CRUD actions for Libros model.
 */
class LibrosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::class,
            'only' => ['index', 'view', 'create', 'update', 'delete'],
            'rules' => [
                // admin: todo
                [
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity && Yii::$app->user->identity->isAdmin();
                    }
                ],
                // usuario: solo ver
                [
                    'allow' => true,
                    'actions' => ['index', 'view'],
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity && Yii::$app->user->identity->isUsuario();
                    }
                ],
            ],
        ],
    ];
}

    /**
     * Lists all Libros models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LibrosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libros model.
     * @param int $id_libro Id Libro
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_libro)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_libro),
        ]);
    }

    /**
     * Creates a new Libros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
   public function actionCreate()
    {
        $model = new Libros();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->portadaFile = UploadedFile::getInstance($model, 'portadaFile');
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            
            if ($model->uploadAndSave()) {
                return $this->redirect(['view', 'id_libro' => $model->id_libro]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Libros model.
     */
    public function actionUpdate($id_libro)
    {
        $model = $this->findModel($id_libro);

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->portadaFile = UploadedFile::getInstance($model, 'portadaFile');
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            
            if ($model->uploadAndSave()) {
                return $this->redirect(['view', 'id_libro' => $model->id_libro]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Libros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_libro Id Libro
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_libro)
    {
        $this->findModel($id_libro)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Libros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_libro Id Libro
     * @return Libros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_libro)
    {
        if (($model = Libros::findOne(['id_libro' => $id_libro])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
