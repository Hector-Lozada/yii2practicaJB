<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LibrosCategorias]].
 *
 * @see LibrosCategorias
 */
class LibrosCategoriasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LibrosCategorias[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LibrosCategorias|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
