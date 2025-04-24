<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorias".
 *
 * @property int $idcategorias
 * @property string|null $nombre
 *
 * @property LibrosCategorias[] $librosCategorias
 */
class Categorias extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'default', 'value' => null],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategorias' => Yii::t('app', 'Idcategorias'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * Gets query for [[LibrosCategorias]].
     *
     * @return \yii\db\ActiveQuery|LibrosCategoriasQuery
     */
    public function getLibrosCategorias()
    {
        return $this->hasMany(LibrosCategorias::class, ['categoria_id' => 'idcategorias']);
    }

    /**
     * {@inheritdoc}
     * @return CategoriasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriasQuery(get_called_class());
    }

}
