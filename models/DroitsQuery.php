<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Droits]].
 *
 * @see Droits
 */
class DroitsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Droits[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Droits|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
