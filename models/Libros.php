<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $idlibros
 * @property string|null $titulo
 * @property string|null $autor
 * @property string|null $genero
 * @property int|null $anio
 *
 * @property LibrosCategorias[] $librosCategorias
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
            [['titulo', 'autor', 'genero', 'anio'], 'default', 'value' => null],
            [['anio'], 'integer'],
            [['titulo', 'autor'], 'string', 'max' => 100],
            [['genero'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idlibros' => Yii::t('app', 'Idlibros'),
            'titulo' => Yii::t('app', 'Titulo'),
            'autor' => Yii::t('app', 'Autor'),
            'genero' => Yii::t('app', 'Genero'),
            'anio' => Yii::t('app', 'Anio'),
        ];
    }

    /**
     * Gets query for [[LibrosCategorias]].
     *
     * @return \yii\db\ActiveQuery|LibrosCategoriasQuery
     */
    public function getLibrosCategorias()
    {
        return $this->hasMany(LibrosCategorias::class, ['libro_id' => 'idlibros']);
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery|PrestamosQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::class, ['libro_id' => 'idlibros']);
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
