<?php

namespace app\models;

use app\controllers\Utils;
use Yii;

/**
 * This is the model class for table "frais".
 *
 * @property int $ID_FRAIS
 * @property int $ID_DOSSIER
 * @property double $MONTANT
 * @property string $DATE_REGLE
 * @property string $NATURE_FRAIS
 *
 * @property Dossier $dOSSIER
 */
class Frais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_DOSSIER', 'MONTANT', 'REMETTANT', 'DATE_REGLE'], 'required'],
            [['ID_FRAIS', 'ID_DOSSIER'], 'integer'],
            [['MONTANT'], 'number'],
            [['REMETTANT'], 'string', 'max' => 255],
            [['MONTANT'], 'validateMontant'],
            [['DATE_REGLE'], 'safe'],
            [['ID_FRAIS'], 'unique'],
            [['ID_DOSSIER'], 'exist', 'skipOnError' => true, 'targetClass' => Dossier::class, 'targetAttribute' => ['ID_DOSSIER' => 'ID_DOSSIER']],
        ];
    }

    public function validateMontant($attribute, $params)
    {
        if ($this->getDifference() <= 0) {
            $this->addError($attribute, 'Les frais de dossier ont été déja soldé');
        } elseif ($this->MONTANT > $this->getDifference()) {
            $this->addError($attribute, 'Le montant est supérieur au reste à payer');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_FRAIS' => Yii::t('app', 'Frais'),
            'ID_DOSSIER' => Yii::t('app', 'Dossier'),
            'MONTANT' => Yii::t('app', 'Montant'),
            'DATE_REGLE' => Yii::t('app', 'Date Reglement'),
            'REMETTANT' => Yii::t('app', 'Nom et prénom du remettant'),
            'NATURE_FRAIS' => Yii::t('app', 'Nature Frais'),
            'difference' => Yii::t('app', 'Reste à Payer'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSSIER()
    {
        return $this->hasOne(Dossier::class, ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     *
     */
    public function getDifference()
    {
        $fraisSearch = new FraisSearch();
        $resteAPayer = $fraisSearch->resteAPayer($this->ID_DOSSIER);
        return $resteAPayer['RESTE_A_PAYER'];
    }

    public function getMontantEnLettre()
    {
        $devise = SysParam::findOne('DEVISE');
        return ucfirst(Utils::numberConverter($this->MONTANT) . ' ' . $devise->PARAM_VALUE);
    }

    public function getClient()
    {
        return Client::findOne(['ID_CLIENT' => Dossier::findOne(['ID_DOSSIER' => $this->ID_DOSSIER])->ID_CLIENT])->getCivilite();
    }
}
