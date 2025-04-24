<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros_categorias".
 *
 * @property int $idlibros_categorias
 * @property int|null $libro_id
 * @property int|null $categoria_id
 *
 * @property Categorias $categoria
 * @property Libros $libro
 */
class LibrosCategorias extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros_categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libro_id', 'categoria_id'], 'default', 'value' => null],
            [['libro_id', 'categoria_id'], 'integer'],
            [['libro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Libros::class, 'targetAttribute' => ['libro_id' => 'idlibros']],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'idcategorias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idlibros_categorias' => Yii::t('app', 'Idlibros Categorias'),
            'libro_id' => Yii::t('app', 'Libro ID'),
            'categoria_id' => Yii::t('app', 'Categoria ID'),
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery|CategoriasQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['idcategorias' => 'categoria_id']);
    }

    /**
     * Gets query for [[Libro]].
     *
     * @return \yii\db\ActiveQuery|LibrosQuery
     */
    public function getLibro()
    {
        return $this->hasOne(Libros::class, ['idlibros' => 'libro_id']);
    }

    /**
     * {@inheritdoc}
     * @return LibrosCategoriasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LibrosCategoriasQuery(get_called_class());
    }

}
