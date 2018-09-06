<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 06/09/2018
 * Time: 09:37
 */

namespace app\models;


use yii\db\ActiveQuery;

class DossierQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Dossier[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dossier|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     *
     *
     */
    public function dossierByDroit(){

    }
}