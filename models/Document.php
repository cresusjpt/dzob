<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $ID_DOC
 * @property int $ID_DOSSIER
 * @property string $TITRE_DOC
 * @property string $DESCRIPTION_DOC
 * @property string $DATE_DOC
 * @property string $DATE_EFFECTIVE
 * @property string $CREATEUR
 * @property string $SOURCE
 *
 * @property Contenir[] $contenirs
 * @property Metadonnee[] $mETAs
 * @property Dossier $dOSSIER
 */
class Document extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_DOSSIER', 'TITRE_DOC', 'DESCRIPTION_DOC', 'DATE_DOC', 'CREATEUR', 'SOURCE'], 'required'],
            [['ID_DOSSIER'], 'integer'],
            [['file'], 'file'],
            [['DATE_DOC', 'DATE_EFFECTIVE'], 'safe'],
            [['TITRE_DOC', 'CREATEUR'], 'string', 'max' => 50],
            [['DESCRIPTION_DOC'], 'string', 'max' => 5000],
            [['SOURCE'], 'string', 'max' => 150],
            [['ID_DOSSIER'], 'exist', 'skipOnError' => true, 'targetClass' => Dossier::class, 'targetAttribute' => ['ID_DOSSIER' => 'ID_DOSSIER']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_DOC' => Yii::t('app', 'Document'),
            'file' => Yii::t('app', 'Fichier'),
            'ID_DOSSIER' => Yii::t('app', 'Dossier'),
            'TITRE_DOC' => Yii::t('app', 'Titre  Doc'),
            'DESCRIPTION_DOC' => Yii::t('app', 'Description Document'),
            'DATE_DOC' => Yii::t('app', 'Date Document'),
            'DATE_EFFECTIVE' => Yii::t('app', 'Date Effective'),
            'CREATEUR' => Yii::t('app', 'Createur'),
            'SOURCE' => Yii::t('app', 'Source'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContenirs()
    {
        return $this->hasMany(Contenir::className(), ['ID_DOC' => 'ID_DOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMETAs()
    {
        return $this->hasMany(Metadonnee::class, ['ID_META' => 'ID_META'])->viaTable('contenir', ['ID_DOC' => 'ID_DOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSSIER()
    {
        return $this->hasOne(Dossier::class, ['ID_DOSSIER' => 'ID_DOSSIER']);
    }
}
