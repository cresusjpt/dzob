<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GrUsager]].
 *
 * @see GrUsager
 */
class GrUsagerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GrUsager[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrUsager|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
