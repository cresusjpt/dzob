<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dossier".
 *
 * @property int $ID_DOSSIER
 * @property int $ID_CLASSEUR
 * @property int $ID_PERSONNE
 * @property int $ID_CLIENT
 * @property int $DOS_ID_DOSSIER
 * @property string $LIBELLE_DOSSIER
 * @property string $COMMENTAIRE_DOSSIER
 * @property string $DATE_CREATION
 * @property string $DATE_DMDOSSIER
 * @property double $FRAIS_DOSSIER
 * @property int $ETAT_DOSSIER_TRAITEMENT
 * @property string $STATUT_DOSSIER
 *
 * @property Document[] $documents
 * @property Classeur $cLASSEUR
 * @property Client $pERSONNE
 * @property Dossier $dOSIDDOSSIER
 * @property Dossier[] $dossiers
 * @property Frais[] $frais
 * @property GrUsager[] $grUsagers
 * @property Modifier[] $modifiers
 * @property Versionning[] $vERSIONs
 * @property Subir[] $subirs
 * @property Traitement[] $tRAITEMENTs
 */
class Dossier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dossier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_CLASSEUR', 'ID_CLIENT', 'LIBELLE_DOSSIER', 'DATE_CREATION', 'FRAIS_DOSSIER', 'ETAT_DOSSIER_TRAITEMENT'], 'required'],
            [['ID_CLASSEUR', 'ID_PERSONNE', 'ID_CLIENT', 'DOS_ID_DOSSIER'], 'integer'],
            [['DATE_CREATION', 'DATE_DMDOSSIER'], 'safe'],
            [['FRAIS_DOSSIER'], 'number'],
            [['LIBELLE_DOSSIER', 'STATUT_DOSSIER'], 'string', 'max' => 50],
            [['COMMENTAIRE_DOSSIER'], 'string', 'max' => 500],
            [['ETAT_DOSSIER_TRAITEMENT'], 'string', 'max' => 1],
            [['ID_DOSSIER'], 'unique'],
            [['ID_CLASSEUR'], 'exist', 'skipOnError' => true, 'targetClass' => Classeur::className(), 'targetAttribute' => ['ID_CLASSEUR' => 'ID_CLASSEUR']],
            [['DOS_ID_DOSSIER'], 'exist', 'skipOnError' => true, 'targetClass' => Dossier::className(), 'targetAttribute' => ['DOS_ID_DOSSIER' => 'ID_DOSSIER']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_DOSSIER' => Yii::t('app', 'Dossier'),
            'ID_CLASSEUR' => Yii::t('app', 'Classeur'),
            'ID_PERSONNE' => Yii::t('app', 'Personne'),
            'ID_CLIENT' => Yii::t('app', 'Client'),
            'DOS_ID_DOSSIER' => Yii::t('app', 'Dossier parent'),
            'LIBELLE_DOSSIER' => Yii::t('app', 'Libelle  Dossier'),
            'COMMENTAIRE_DOSSIER' => Yii::t('app', 'Commentaire Dossier'),
            'DATE_CREATION' => Yii::t('app', 'Date de Creation'),
            'DATE_DMDOSSIER' => Yii::t('app', 'Date  Dmdossier'),
            'FRAIS_DOSSIER' => Yii::t('app', 'Frais de Dossier'),
            'ETAT_DOSSIER_TRAITEMENT' => Yii::t('app', 'Etat Dossier Traitement'),
            'STATUT_DOSSIER' => Yii::t('app', 'Statut Dossier'),
        ];
    }

    public function getEtatDossier()
    {
        return $this->ETAT_DOSSIER_TRAITEMENT == 0 ? 'En cours' : 'Terminé';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLASSEUR()
    {
        return $this->hasOne(Classeur::className(), ['ID_CLASSEUR' => 'ID_CLASSEUR']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(Client::className(), ['ID_CLIENT' => 'ID_CLIENT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSIDDOSSIER()
    {
        return $this->hasOne(Dossier::className(), ['ID_DOSSIER' => 'DOS_ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDossiers()
    {
        return $this->hasMany(Dossier::className(), ['DOS_ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrais()
    {
        return $this->hasMany(Frais::className(), ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrUsagers()
    {
        return $this->hasMany(GrUsager::className(), ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiers()
    {
        return $this->hasMany(Modifier::className(), ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVERSIONs()
    {
        return $this->hasMany(Versionning::className(), ['ID_VERSION' => 'ID_VERSION'])->viaTable('modifier', ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubirs()
    {
        return $this->hasMany(Subir::className(), ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRAITEMENTs()
    {
        return $this->hasMany(Traitement::className(), ['ID_TRAITEMENT' => 'ID_TRAITEMENT'])->viaTable('subir', ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * {@inheritdoc}
     * @return DossierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DossierQuery(get_called_class());
    }
}
