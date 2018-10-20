<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 06/10/2018
 * Time: 02:48
 */

namespace app\models;


use Yii;

class Sphinxmodele extends \yii\sphinx\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sphinxmodele';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_MODELE'], 'integer'],
            [['NOM_MODELE', 'CONTENU_MODELE'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_MODELE' => Yii::t('app', 'Id  Modele'),
            'NOM_MODELE' => Yii::t('app', 'Nom Modele'),
            'CONTENU_MODELE' => Yii::t('app', 'Contenu du modele'),
        ];
    }

    public function getResult()
    {
        if (empty($this->CONTENU_MODELE))
            return self::find();

        $params = [':modele' => $this->CONTENU_MODELE];
        return self::findBySql("SELECT ID_MODELE, NOM_MODELE, CONTENU_MODELE FROM sphinxmodele WHERE MATCH (:modele)", $params);
    }

}