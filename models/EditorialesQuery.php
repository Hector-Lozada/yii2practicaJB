<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Editoriales]].
 *
 * @see Editoriales
 */
class EditorialesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Editoriales[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Editoriales|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
