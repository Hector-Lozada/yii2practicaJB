<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prestamos".
 *
 * @property int $idprestamos
 * @property int|null $usuario_id
 * @property int|null $libro_id
 * @property string|null $fecha_prestamo
 * @property string|null $fecha_devolucion
 *
 * @property Libros $libro
 * @property Usuarios $usuario
 */
class Prestamos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prestamos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'libro_id', 'fecha_prestamo', 'fecha_devolucion'], 'default', 'value' => null],
            [['usuario_id', 'libro_id'], 'integer'],
            [['fecha_prestamo', 'fecha_devolucion'], 'safe'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'idusuarios']],
            [['libro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Libros::class, 'targetAttribute' => ['libro_id' => 'idlibros']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprestamos' => Yii::t('app', 'Idprestamos'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'libro_id' => Yii::t('app', 'Libro ID'),
            'fecha_prestamo' => Yii::t('app', 'Fecha Prestamo'),
            'fecha_devolucion' => Yii::t('app', 'Fecha Devolucion'),
        ];
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
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['idusuarios' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return PrestamosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PrestamosQuery(get_called_class());
    }

}
