<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Rdv]].
 *
 * @see Rdv
 */
class RdvQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Rdv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Rdv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
