<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Valeur]].
 *
 * @see Valeur
 */
class ValeurQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Valeur[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Valeur|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
