<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valeur".
 *
 * @property int $ID_VALEUR
 * @property string $REFERENCE_PATRIMOINE
 * @property string $TYPE_PATRIMOINE
 * @property double $MONTANT
 * @property string $DATE_DEBUT
 * @property string $DATE_FIN
 * @property string $REF_TYPE_PATRIMOINE
 *
 * @property Immobilier $rEFERENCEPATRIMOINE
 * @property Mobilier $rEFERENCEPATRIMOINE0
 */
class Valeur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valeur';
    }

    /**
     * {@inheritdoc}
     * @return ValeurQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ValeurQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE', 'TYPE_PATRIMOINE', 'MONTANT', 'DATE_DEBUT', 'REF_TYPE_PATRIMOINE'], 'required'],
            [['TYPE_PATRIMOINE'], 'string'],
            [['MONTANT'], 'number'],
            [['DATE_DEBUT', 'DATE_FIN'], 'safe'],
            [['DATE_FIN'], 'validateFin'],
            [['REFERENCE_PATRIMOINE', 'REF_TYPE_PATRIMOINE'], 'string', 'max' => 10],
            [['REFERENCE_PATRIMOINE'], 'exist', 'skipOnError' => true, 'targetClass' => Immobilier::class, 'targetAttribute' => ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']],
            [['REFERENCE_PATRIMOINE'], 'exist', 'skipOnError' => true, 'targetClass' => Mobilier::class, 'targetAttribute' => ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']],
        ];
    }

    public function validateFin($attribute, $params)
    {
        if ($this->DATE_DEBUT > $this->DATE_FIN) {
            $this->addError($attribute, 'La date de fin ne peut être antérieure à la date de fin');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_VALEUR' => Yii::t('app', 'Id  Valeur'),
            'REFERENCE_PATRIMOINE' => Yii::t('app', 'Reference  Patrimoine'),
            'TYPE_PATRIMOINE' => Yii::t('app', 'Type  Patrimoine'),
            'MONTANT' => Yii::t('app', 'Montant'),
            'DATE_DEBUT' => Yii::t('app', 'Date  Debut'),
            'DATE_FIN' => Yii::t('app', 'Date  Fin'),
            'REF_TYPE_PATRIMOINE' => Yii::t('app', 'Nom  Type  Patrimoine'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCEPATRIMOINE()
    {
        return $this->hasOne(Immobilier::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCEPATRIMOINE0()
    {
        return $this->hasOne(Mobilier::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }
}
