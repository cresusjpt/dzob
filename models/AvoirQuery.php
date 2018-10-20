<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Avoir]].
 *
 * @see Avoir
 */
class AvoirQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Avoir[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Avoir|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
