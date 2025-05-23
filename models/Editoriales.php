<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "editoriales".
 *
 * @property int $id_editorial
 * @property string $nombre
 * @property string|null $pais
 * @property string|null $fundacion
 *
 * @property Libros[] $libros
 */
class Editoriales extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'editoriales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pais', 'fundacion'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['fundacion'], 'safe'],
            [['nombre', 'pais'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_editorial' => Yii::t('app', 'Id Editorial'),
            'nombre' => Yii::t('app', 'Nombre'),
            'pais' => Yii::t('app', 'Pais'),
            'fundacion' => Yii::t('app', 'Fundacion'),
        ];
    }

    /**
     * Gets query for [[Libros]].
     *
     * @return \yii\db\ActiveQuery|LibrosQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libros::class, ['id_editorial' => 'id_editorial']);
    }

    /**
     * {@inheritdoc}
     * @return EditorialesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EditorialesQuery(get_called_class());
    }

}
