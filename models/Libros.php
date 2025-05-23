<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id_libro
 * @property string $titulo
 * @property int $id_autor
 * @property int $id_categoria
 * @property int|null $id_editorial
 * @property string|null $isbn
 * @property string|null $anio_publicacion
 * @property int|null $paginas
 * @property string|null $sinopsis
 * @property string|null $portada Ruta de la imagen de portada
 * @property string|null $archivo_pdf Ruta del archivo PDF del libro
 * @property string|null $fecha_agregado
 * @property int|null $disponible
 *
 * @property Autores $autor
 * @property Categorias $categoria
 * @property Editoriales $editorial
 * @property Prestamos[] $prestamos
 */
class Libros extends \yii\db\ActiveRecord
{


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
            [['id_editorial', 'isbn', 'anio_publicacion', 'paginas', 'sinopsis', 'portada', 'archivo_pdf'], 'default', 'value' => null],
            [['disponible'], 'default', 'value' => 1],
            [['titulo', 'id_autor', 'id_categoria'], 'required'],
            [['id_autor', 'id_categoria', 'id_editorial', 'paginas', 'disponible'], 'integer'],
            [['anio_publicacion', 'fecha_agregado'], 'safe'],
            [['sinopsis'], 'string'],
            [['titulo', 'portada', 'archivo_pdf'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 20],
            [['isbn'], 'unique'],
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
            'id_libro' => Yii::t('app', 'Id Libro'),
            'titulo' => Yii::t('app', 'Titulo'),
            'id_autor' => Yii::t('app', 'Id Autor'),
            'id_categoria' => Yii::t('app', 'Id Categoria'),
            'id_editorial' => Yii::t('app', 'Id Editorial'),
            'isbn' => Yii::t('app', 'Isbn'),
            'anio_publicacion' => Yii::t('app', 'Anio Publicacion'),
            'paginas' => Yii::t('app', 'Paginas'),
            'sinopsis' => Yii::t('app', 'Sinopsis'),
            'portada' => Yii::t('app', 'Portada'),
            'archivo_pdf' => Yii::t('app', 'Archivo Pdf'),
            'fecha_agregado' => Yii::t('app', 'Fecha Agregado'),
            'disponible' => Yii::t('app', 'Disponible'),
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery|AutoresQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autores::class, ['id_autor' => 'id_autor']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery|CategoriasQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Editorial]].
     *
     * @return \yii\db\ActiveQuery|EditorialesQuery
     */
    public function getEditorial()
    {
        return $this->hasOne(Editoriales::class, ['id_editorial' => 'id_editorial']);
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery|PrestamosQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::class, ['id_libro' => 'id_libro']);
    }

    /**
     * {@inheritdoc}
     * @return LibrosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LibrosQuery(get_called_class());
    }

}
