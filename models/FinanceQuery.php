<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Finance]].
 *
 * @see Finance
 */
class FinanceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Finance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Finance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
