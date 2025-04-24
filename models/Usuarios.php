<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $idusuarios
 * @property string|null $nombre
 * @property string|null $email
 * @property string|null $tipo_usuario
 *
 * @property Prestamos[] $prestamos
 */
class Usuarios extends \yii\db\ActiveRecord
{


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
            [['nombre', 'email', 'tipo_usuario'], 'default', 'value' => null],
            [['nombre', 'email'], 'string', 'max' => 100],
            [['tipo_usuario'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idusuarios' => Yii::t('app', 'Idusuarios'),
            'nombre' => Yii::t('app', 'Nombre'),
            'email' => Yii::t('app', 'Email'),
            'tipo_usuario' => Yii::t('app', 'Tipo Usuario'),
        ];
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery|PrestamosQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::class, ['usuario_id' => 'idusuarios']);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }

}
