<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

class UsuariosController extends Controller
{
    public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::class,
            'only' => ['index', 'view', 'create', 'update', 'delete'], // todas las acciones
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'], // autenticado
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity && Yii::$app->user->identity->isAdmin();
                    }
                ],
            ],
        ],
    ];
}

    /**
     * Lista todos los usuarios.
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un solo usuario.
     */
    public function actionView($id_usuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_usuario),
        ]);
    }

    /**
     * Crea un nuevo usuario.
     */
    public function actionCreate()
    {
        $model = new Usuarios();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            // Validación temporal
            $model->imagen_perfil = 'temp';
            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('create', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Procesar imagen
                if ($model->imageFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/images/');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0775, true);
                    }

                    $fileName = uniqid() . '.' . $model->imageFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->imageFile->saveAs($filePath)) {
                        $model->imagen_perfil = '/uploads/images/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar la imagen.');
                    }
                }

                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Usuario creado exitosamente.');
                    return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
                } else {
                    throw new \Exception('Error al guardar: ' . print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                if (isset($filePath) && file_exists($filePath)) {
                    unlink($filePath);
                }
                Yii::$app->session->setFlash('error', $e->getMessage());
                Yii::error($e->getMessage());
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id_usuario)
    {
        $model = $this->findModel($id_usuario);
        $oldImagePath = $model->imagen_perfil;

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('update', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Procesar nueva imagen si se subió
                if ($model->imageFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/images/');
                    $fileName = uniqid() . '.' . $model->imageFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->imageFile->saveAs($filePath)) {
                        // Eliminar la imagen anterior
                        if ($oldImagePath && file_exists(Yii::getAlias('@webroot' . $oldImagePath))) {
                            unlink(Yii::getAlias('@webroot' . $oldImagePath));
                        }
                        $model->imagen_perfil = '/uploads/images/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar la nueva imagen.');
                    }
                }

                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Usuario actualizado exitosamente.');
                    return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
                } else {
                    throw new \Exception('Error al actualizar: ' . print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
                Yii::error($e->getMessage());
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id_usuario)
    {
        $model = $this->findModel($id_usuario);
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->delete()) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Empleado eliminado exitosamente.');
            } else {
                throw new \Exception('No se pudo eliminar el empleado.');
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
            Yii::error($e->getMessage());
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id_usuario)
    {
        if (($model = Usuarios::findOne($id_usuario)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El empleado solicitado no existe.');
    }

    private function getErrorSummary($model)
    {
        $errors = [];
        foreach ($model->errors as $attribute => $errorMessages) {
            $label = $model->getAttributeLabel($attribute);
            $errors[] = "$label: " . implode(', ', $errorMessages);
        }
        return implode('<br>', $errors);
    }
}
