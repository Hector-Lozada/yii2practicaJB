<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PedidoDetalles]].
 *
 * @see PedidoDetalles
 */
class PedidoDetallesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PedidoDetalles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PedidoDetalles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
