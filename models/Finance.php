<?php

namespace app\models;

use app\controllers\Utils;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "finance".
 *
 * @property int $ID_FINANCE
 * @property string $REFERENCE_PATRIMOINE
 * @property double $MONTANT
 * @property string $DATE_FINANCE
 * @property string $NATURE_FINANCE
 * @property string $TYPE_PATRIMOINE
 *
 * @property Immobilier $rEFERENCEPATRIMOINE
 * @property Mobilier $rEFERENCEPATRIMOINE0
 */
class Finance extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance';
    }

    /**
     * {@inheritdoc}
     * @return FinanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FinanceQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE', 'MONTANT', 'DATE_FINANCE', 'NATURE_FINANCE', 'TYPE_PATRIMOINE'], 'required'],
            [['MONTANT'], 'number'],
            [['DATE_FINANCE'], 'safe'],
            [['file'], 'file'],
            [['NATURE_FINANCE'], 'string'],
            [['REFERENCE_PATRIMOINE'], 'string', 'max' => 10],
            [['REFERENCE_PATRIMOINE'], 'exist', 'skipOnError' => true, 'targetClass' => Patrimoine::class, 'targetAttribute' => ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_FINANCE' => Yii::t('app', 'Id  Finance'),
            'REFERENCE_PATRIMOINE' => Yii::t('app', 'Reference  Patrimoine'),
            'MONTANT' => Yii::t('app', 'Montant'),
            'DATE_FINANCE' => Yii::t('app', 'Date  Finance'),
            'NATURE_FINANCE' => Yii::t('app', 'Nature  Finance'),
            'nOMPatrimoine' => Yii::t('app', 'Nom du patrimoine'),
            'file' => Yii::t('app', 'Justificatif'),
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

    public function getJustificatif()
    {
        if ($this->NATURE_FINANCE == 'ENTREE' && !empty($this->RESSOURCE) && $this->RESSOURCE != 'NON') {
            return 'OUI';
        }
        return 'NON';
    }

    public function getNomPatrimoine()
    {
        return Patrimoine::findOne(['REFERENCE_PATRIMOINE' => $this->REFERENCE_PATRIMOINE])->NOM_PATRIMOINE;
    }

    public function getMontantEnLettre()
    {
        $devise = SysParam::findOne('DEVISE');
        return ucfirst(Utils::numberConverter($this->MONTANT) . ' ' . $devise->PARAM_VALUE);
    }

    /**
     * @return string
     */
    public function getResponsable()
    {
        $id = 0;
        if ($this->TYPE_PATRIMOINE == 'IMMO') {
            $id_immo = Immobilier::findOne(['REFERENCE_PATRIMOINE' => $this->REFERENCE_PATRIMOINE]);
            $id = $id_immo->ID_IMMOBILIER;
        } elseif (($this->TYPE_PATRIMOINE == 'MO')) {
            $id_immo = Mobilier::findOne(['REFERENCE_PATRIMOINE' => $this->REFERENCE_PATRIMOINE]);
            $id = $id_immo->ID_MOBILIER;
        }
        $search = new ImmobilierSearch();
        $responsable = $search->searchResponsable($id, $this->TYPE_PATRIMOINE);

        return $responsable['PRENOM'] . ' ' . $responsable['NOM'];
    }
}
