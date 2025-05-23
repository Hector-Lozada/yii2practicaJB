<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prestamos".
 *
 * @property int $id_prestamo
 * @property int $id_usuario
 * @property int $id_libro
 * @property string|null $fecha_prestamo
 * @property string|null $fecha_devolucion_esperada
 * @property string|null $fecha_devolucion_real
 * @property string|null $estado
 *
 * @property Libros $libro
 * @property Usuarios $usuario
 */
class Prestamos extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_COMPLETADO = 'completado';
    const ESTADO_ATRASADO = 'atrasado';

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
            [['fecha_devolucion_esperada', 'fecha_devolucion_real'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'activo'],
            [['id_usuario', 'id_libro'], 'required'],
            [['id_usuario', 'id_libro'], 'integer'],
            [['fecha_prestamo', 'fecha_devolucion_esperada', 'fecha_devolucion_real'], 'safe'],
            [['estado'], 'string'],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario' => 'id_usuario']],
            [['id_libro'], 'exist', 'skipOnError' => true, 'targetClass' => Libros::class, 'targetAttribute' => ['id_libro' => 'id_libro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prestamo' => Yii::t('app', 'Id Prestamo'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'id_libro' => Yii::t('app', 'Id Libro'),
            'fecha_prestamo' => Yii::t('app', 'Fecha Prestamo'),
            'fecha_devolucion_esperada' => Yii::t('app', 'Fecha Devolucion Esperada'),
            'fecha_devolucion_real' => Yii::t('app', 'Fecha Devolucion Real'),
            'estado' => Yii::t('app', 'Estado'),
        ];
    }

    /**
     * Gets query for [[Libro]].
     *
     * @return \yii\db\ActiveQuery|LibrosQuery
     */
    public function getLibro()
    {
        return $this->hasOne(Libros::class, ['id_libro' => 'id_libro']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id_usuario' => 'id_usuario']);
    }

    /**
     * {@inheritdoc}
     * @return PrestamosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PrestamosQuery(get_called_class());
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_ACTIVO => Yii::t('app', 'activo'),
            self::ESTADO_COMPLETADO => Yii::t('app', 'completado'),
            self::ESTADO_ATRASADO => Yii::t('app', 'atrasado'),
        ];
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoActivo()
    {
        return $this->estado === self::ESTADO_ACTIVO;
    }

    public function setEstadoToActivo()
    {
        $this->estado = self::ESTADO_ACTIVO;
    }

    /**
     * @return bool
     */
    public function isEstadoCompletado()
    {
        return $this->estado === self::ESTADO_COMPLETADO;
    }

    public function setEstadoToCompletado()
    {
        $this->estado = self::ESTADO_COMPLETADO;
    }

    /**
     * @return bool
     */
    public function isEstadoAtrasado()
    {
        return $this->estado === self::ESTADO_ATRASADO;
    }

    public function setEstadoToAtrasado()
    {
        $this->estado = self::ESTADO_ATRASADO;
    }
}
