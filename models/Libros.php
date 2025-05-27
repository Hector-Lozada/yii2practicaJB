<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "libros".
 */
class Libros extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $portadaFile;
    
    /**
     * @var UploadedFile
     */
    public $pdfFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'id_autor', 'id_categoria'], 'required'],
            [['id_autor', 'id_categoria', 'id_editorial', 'paginas', 'disponible'], 'integer'],
            [['anio_publicacion', 'fecha_agregado'], 'safe'],
            [['sinopsis'], 'string'],
            [['titulo', 'portada', 'archivo_pdf'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 20],
            [['isbn'], 'unique'],
            [['portadaFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 5*1024*1024],
            [['pdfFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 20*1024*1024],
            [['id_autor'], 'exist', 'skipOnError' => true, 'targetClass' => Autores::class, 'targetAttribute' => ['id_autor' => 'id_autor']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['id_categoria' => 'id_categoria']],
            [['id_editorial'], 'exist', 'skipOnError' => true, 'targetClass' => Editoriales::class, 'targetAttribute' => ['id_editorial' => 'id_editorial']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_libro' => 'ID Libro',
            'titulo' => 'Título',
            'id_autor' => 'Autor',
            'id_categoria' => 'Categoría',
            'id_editorial' => 'Editorial',
            'isbn' => 'ISBN',
            'anio_publicacion' => 'Año de Publicación',
            'paginas' => 'Páginas',
            'sinopsis' => 'Sinopsis',
            'portada' => 'Portada',
            'portadaFile' => 'Imagen de Portada',
            'archivo_pdf' => 'Archivo PDF',
            'pdfFile' => 'Libro en PDF',
            'fecha_agregado' => 'Fecha de Agregado',
            'disponible' => 'Disponible',
        ];
    }

    /**
     * Upload files and save model
     */
    public function uploadAndSave()
    {
        if ($this->validate()) {
            // Procesar portada
            if ($this->portadaFile) {
                $portadaName = 'portada_' . time() . '.' . $this->portadaFile->extension;
                $this->portadaFile->saveAs('uploads/portadas/' . $portadaName);
                $this->portada = $portadaName;
            }
            
            // Procesar PDF
            if ($this->pdfFile) {
                $pdfName = 'libro_' . time() . '.' . $this->pdfFile->extension;
                $this->pdfFile->saveAs('uploads/pdfs/' . $pdfName);
                $this->archivo_pdf = $pdfName;
            }
            
            // Set fecha_agregado if new record
            if ($this->isNewRecord) {
                $this->fecha_agregado = date('Y-m-d H:i:s');
            }
            
            return $this->save(false); // false para evitar validación doble
        }
        return false;
    }

    // ... (mantén las relaciones existentes)
}