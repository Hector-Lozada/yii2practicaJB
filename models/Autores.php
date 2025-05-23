<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "autores".
 *
 * @property int $id_autor
 * @property string $nombre
 * @property string $apellido
 * @property string|null $biografia
 * @property string|null $fecha_nacimiento
 * @property string|null $fecha_fallecimiento
 * @property string|null $nacionalidad
 *
 * @property Libros[] $libros
 */
class Autores extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['biografia', 'fecha_nacimiento', 'fecha_fallecimiento', 'nacionalidad'], 'default', 'value' => null],
            [['nombre', 'apellido'], 'required'],
            [['biografia'], 'string'],
            [['fecha_nacimiento', 'fecha_fallecimiento'], 'safe'],
            [['nombre', 'apellido', 'nacionalidad'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_autor' => Yii::t('app', 'Id Autor'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'biografia' => Yii::t('app', 'Biografia'),
            'fecha_nacimiento' => Yii::t('app', 'Fecha Nacimiento'),
            'fecha_fallecimiento' => Yii::t('app', 'Fecha Fallecimiento'),
            'nacionalidad' => Yii::t('app', 'Nacionalidad'),
        ];
    }

    /**
     * Gets query for [[Libros]].
     *
     * @return \yii\db\ActiveQuery|LibrosQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libros::class, ['id_autor' => 'id_autor']);
    }

    /**
     * {@inheritdoc}
     * @return AutoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AutoresQuery(get_called_class());
    }

}
