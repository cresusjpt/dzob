<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Versionning]].
 *
 * @see Versionning
 */
class VersionningQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Versionning[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Versionning|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
