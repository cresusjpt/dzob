<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evenement".
 *
 * @property int $ID_EVENEMENT
 * @property string $REFERENCE_PATRIMOINE
 * @property string $LIBELLE_EVENEMENT
 * @property string $COMMENTAIRE_EVENEMENT
 * @property string $DATE_EVENEMENT
 * @property int $ETAT_EVENEMENT
 * @property string $DATE_REALISATION
 *
 * @property Immobilier $rEFERENCEPATRIMOINE
 * @property Mobilier $rEFERENCEPATRIMOINE0
 */
class Evenement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evenement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE', 'LIBELLE_EVENEMENT', 'DATE_EVENEMENT', 'ETAT_EVENEMENT'], 'required'],
            [['ID_EVENEMENT'], 'integer'],
            [['DATE_EVENEMENT', 'DATE_REALISATION'], 'safe'],
            [['REFERENCE_PATRIMOINE'], 'string', 'max' => 11],
            [['LIBELLE_EVENEMENT'], 'string', 'max' => 200],
            [['COMMENTAIRE_EVENEMENT'], 'string', 'max' => 500],
            [['ETAT_EVENEMENT'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_EVENEMENT' => Yii::t('app', 'Id  Evenement'),
            'REFERENCE_PATRIMOINE' => Yii::t('app', 'Reference  Patrimoine'),
            'LIBELLE_EVENEMENT' => Yii::t('app', 'Libelle  Evenement'),
            'COMMENTAIRE_EVENEMENT' => Yii::t('app', 'Commentaire  Evenement'),
            'DATE_EVENEMENT' => Yii::t('app', 'Date  Evenement'),
            'ETAT_EVENEMENT' => Yii::t('app', 'Etat  Evenement'),
            'DATE_REALISATION' => Yii::t('app', 'Date  Réalisation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCEPATRIMOINE()
    {
        return $this->hasOne(Immobilier::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCEPATRIMOINE0()
    {
        return $this->hasOne(Mobilier::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }
}
