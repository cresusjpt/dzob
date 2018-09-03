<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Traitement]].
 *
 * @see Traitement
 */
class TraitementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Traitement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Traitement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
