<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id_usuario
 * @property string $nombre
 * @property string $email
 * @property string|null $imagen_perfil
 * @property string|null $contrasena
 * @property int $estado
 * @property int $rol
 */
class Usuarios extends ActiveRecord
{
    /** @var UploadedFile */
    public $imageFile; // Atributo público para subir imagen

    const ROL_USUARIO = 1;
    const ROL_ADMIN = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
{
    return [
        [['nombre', 'apellido', 'email', 'contrasena', 'rol', 'fecha_registro'], 'required'],
        [['estado'], 'integer'],
        [['nombre', 'apellido', 'email', 'contrasena', 'imagen_perfil', 'rol'], 'string', 'max' => 255],
        [['email'], 'email'],
        [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
    ];
}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'ID',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'imagen_perfil' => 'Imagen de Perfil',
            'imageFile' => 'Foto de Perfil',
            'contrasena' => 'Contraseña',
            'estado' => 'Estado',
            'rol' => 'Rol',
        ];
    }

    /**
     * Sube la imagen y guarda la ruta
     *
     * @return bool
     */
    public function upload()
    {
        if ($this->imageFile instanceof UploadedFile) {
            $uploadDir = Yii::getAlias('@webroot/uploads/images/');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $fileName = uniqid() . '.' . $this->imageFile->extension;
            $filePath = $uploadDir . $fileName;

            if ($this->imageFile->saveAs($filePath)) {
                $this->imagen_perfil = '/uploads/images/' . $fileName;
                return true;
            }
        }

        return false;
    }

    /**
     * Elimina la imagen asociada al usuario
     *
     * @return bool
     */
    public function deleteImage()
    {
        $imagePath = Yii::getAlias('@webroot' . $this->imagen_perfil);
        if ($this->imagen_perfil && file_exists($imagePath)) {
            return unlink($imagePath);
        }
        return false;
    }

    /**
     * Antes de eliminar, elimina la imagen si existe
     *
     * @return bool
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $this->deleteImage();
        return true;
    }
}
