<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'usuarios';
    }

    // Si tu PK NO es 'id', ajusta este método
    // public static function primaryKey() { return ['idusuario']; }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    // Cambiar para buscar por email
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    // Si quieres compatibilidad con findByUsername() para el LoginForm:
    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }

    public function validatePassword($password)
    {
        // Si guardas hash, usa Yii::$app->security->validatePassword($password, $this->password)
        return $this->contrasena === $password;
    }
    public function isAdmin() {
    return $this->rol === 'admin';
}
public function isUsuario() {
    return $this->rol === 'usuario';
}
}